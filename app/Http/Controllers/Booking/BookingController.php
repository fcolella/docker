<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Mail;//  https://laravel.com/docs/5.1/mail && http://dixitpatel.com/form-in-laravel-with-email-function/
use App\Http\Controllers\Gulliver;
use App\Http\Controllers\Booking\PaymentGatewayDataModel;
use App\Http\Controllers\Booking\PaymentProductDataModel;
use App\Http\Controllers\Booking\PaymentGulliverDataModel;

class BookingController extends Controller
{
	static $form = [];

	function __construct()
	{
		parent::__construct();
	}

	function Calculations()
	{
		Request::setMethod('POST');
		//
	//	$banco      = Request::get('banco',0);
		$banco_id   = Request::get('banco_id',0);
		$tarjeta    = Request::get('tarjeta',0);
		$cuotas     = Request::get('cuotas',0);
		$uatp       = Request::get('uatp','false');
		$aerolinea  = Request::get('aerolinea',0);
		//
		if ('false'!=$uatp) {
			$result = DB::select('SELECT coeficiente FROM vw_cuotas_air WHERE cod_decidir = '.$tarjeta.' AND banco_id = '.$banco_id.' AND cantidad_cuotas = '.$cuotas.' AND aerolinea_codigo = "'.$aerolinea.'"');
		} else {
			$result = DB::select('SELECT C.coeficiente, C.coef_bonif_banco FROM cuotas C JOIN bancos B ON B.id = C.banco_id JOIN tarjetas T ON T.codigo = C.tarjeta_codigo WHERE T.cod_decidir = '.$tarjeta.' AND C.banco_id = '.$banco_id.' AND C.cantidad_cuotas = '.$cuotas);
		}
		//
		return Response::json([
			'coeficiente'   => (!empty($result[0]->coeficiente))        ? $result[0]->coeficiente       : 0,
			'bonificacion'  => (!empty($result[0]->coef_bonif_banco))   ? $result[0]->coef_bonif_banco  : 0
		],200);
	}

	static function displayCommons($totalAmount=0)
	{
		$tester = ((false==empty($_COOKIE['tester'])) && $_COOKIE['tester'] == 'tester') ? true : false;
		$tester = ((false==empty($_GET['tester'])) && $_GET['tester'] == 'tester') ? true : $tester;

		self::addJsFooter('bootstrap/bootstrap-select.js');
		self::addJsFooter('jquery-ui/jquery.ui.autocomplete.js');
		self::addJsFooter('booking/select-autocomplete.js');
		self::addJsFooter('booking/init.js');
		view()->share([
			'CREDITO_GARBARINO_ID'      => 0,
			'gastos'                    => 0,
			'datosVendedor'             => false,
			'osName'                    => "",
			'intereses'                 => 0,
			'bonificacion'              => 0,
			'cargosGestion'             => 0,
			'coefDescuento'             => 0,
			'descCargosGestion'         => 0,

			'testuser'                  => $tester,
			'totalAmount'               => $totalAmount,
			'InstallmentsWOinterest'    => self::getInstallmentsWOinterest(),
			'InstallmentsWinterest'     => self::getInstallmentsWinterest(),
			'InstallmentsOtherBanks'    => self::getInstallmentsOtherBanks(),
			'InstallmentsUatp'          => self::getInstallmentsUatp(),
			'Nationalities'             => self::getNationalities(),
			'CitiesAutocomplete'        => '/compra/CitiesAutocomplete',
			'FormAction'                => Request::url().'?'.http_build_query(\Request::all()),
			'States'                    => self::getStates(),
			'Months'                    => self::getMonths()
		]);
		Controller::addCss('1200.css');
		Controller::addCss('booking.css');
		if (true===$tester) {
			self::addJsFooter('booking/tester.js');
		}
	}

	static function getCities()
	{
		return Gulliver::getCities('AR');
	}

	static function getStates()
	{
		$states = DB::table('cache_gulliver_states')->select('*')->get();
		if (empty($states)) {
			$states = Gulliver::getStates('AR');

			$insert = [];
			foreach($states as $state){
				$insert[] = ['code'=>$state['code'],'name'=>utf8_encode($state['name'])];
			}
			DB::table('cache_gulliver_states')->insert($insert);
			$states = DB::select('SELECT * FROM cache_gulliver_states')->get();
		}
		return $states;
	}

	//  Ajax call
	function CitiesAutocomplete()
	{
		Request::setMethod('GET');
		$stateCode = Request::get('stateCode',"");
		$stateCode = filter_var($stateCode, FILTER_SANITIZE_STRING);
		$cityName = Request::get('cityName',"");
		$cityName  = filter_var($cityName, FILTER_SANITIZE_STRING);
		//
		$cityResult=[];
		if ("" != $cityName) {
			$cities = DB::table('cache_gulliver_states')->select('cities')->where('code', $stateCode)->get();
			$cities = json_decode($cities[0]->cities);
			foreach($cities as $city) {
				if ($city->name == $cityName) {
					$cityResult = $city;
					break;
				}
			}
			return Response::json($cityResult,200);
		} else {
			$cities = DB::table('cache_gulliver_states')->select('cities')->where('code', $stateCode)->get();
			if (true==empty($cities[0]->cities)) {
				$cities = Gulliver::getCities('AR',$stateCode);
				DB::table('cache_gulliver_states')->where('code', $stateCode)->update(['cities' => json_encode($cities)]);
			} else {
				$cities = json_decode($cities[0]->cities);
			}
			return Response::json($cities,200);
		}
	}

	static function getMonths()
	{
		return [
			'1'     => ['nombre'=>'Enero',      'dias'=>31],
			'2'     => ['nombre'=>'Febrero',    'dias'=>28],
			'3'     => ['nombre'=>'Marzo',      'dias'=>31],
			'4'     => ['nombre'=>'Abril',      'dias'=>30],
			'5'     => ['nombre'=>'Mayo',       'dias'=>31],
			'6'     => ['nombre'=>'Junio',      'dias'=>30],
			'7'     => ['nombre'=>'Julio',      'dias'=>31],
			'8'     => ['nombre'=>'Agosto',     'dias'=>31],
			'9'     => ['nombre'=>'Septiembre', 'dias'=>30],
			'10'    => ['nombre'=>'Octubre',    'dias'=>31],
			'11'    => ['nombre'=>'Noviembre',  'dias'=>30],
			'12'    => ['nombre'=>'Diciembre',  'dias'=>31]
		];
	}

	static function getNationalities()
	{
		return (array) DB::select('SELECT cod_pais, descripcion FROM paises ORDER BY descripcion');
	}

	//  Cuotas sin interes
	static function getInstallmentsWOinterest()
	{
		$Installments = DB::select('SELECT cantidad_cuotas FROM cuotas WHERE coeficiente = 0 AND cantidad_cuotas != 1 AND banco_id != 15 GROUP BY cantidad_cuotas ORDER BY cantidad_cuotas DESC');
		//
		$options=[];
		foreach ($Installments as $Installment) {
			$options[] = self::getPaymentOptions($Installment->cantidad_cuotas, true, false);
		}
		return $options;
	}

	//  Cuotas con interes
	static function getInstallmentsWinterest()
	{
		$Installments = DB::select('SELECT cantidad_cuotas FROM cuotas WHERE cantidad_cuotas != 1 AND coeficiente != 0 AND banco_id != 15 GROUP BY cantidad_cuotas ORDER BY cantidad_cuotas DESC');
		$options=[];
		foreach ($Installments as $Installment) {
			$options[] = self::getPaymentOptions($Installment->cantidad_cuotas, false, false);
		}
		return $options;
	}

	//  Otros bancos
	static function getInstallmentsOtherBanks()
	{
		$whereAmount = "";
		if (defined('uatpAirlineCode')) {
			$whereAmount = " AND cantidad_cuotas != 1 ";
		}
		$Installments = DB::select('SELECT cantidad_cuotas FROM cuotas WHERE banco_id = 15 '.$whereAmount.' GROUP BY cantidad_cuotas ORDER BY cantidad_cuotas ASC');
		$options=[];
		foreach ($Installments as $Installment) {
			$options[] = self::getPaymentOptions($Installment->cantidad_cuotas, false, true);
		}
		return $options;
	}

	//  UATP
	static function getInstallmentsUatp()
	{
		$options=[];
		return $options;
	}

	static function getPaymentOptions($sharesAmount=1, $interest=false, $all=false)
	{
		$PaymentOption = [
			'cuotas'        => $sharesAmount,
			'paymentCombo'  => []
		];

		if ($interest == true && $all == false) {
			$coefficient = ' AND C.coeficiente = 0';
			$bankId = ' AND C.banco_id != 15';
		} elseif ($interest == false && $all == false) {
			$coefficient = ' AND C.coeficiente != 0';
			$bankId = ' AND C.banco_id != 15';
		} else {
			$coefficient = '';
			$bankId = ' AND C.banco_id = 15';
		}

		//
		$rows = DB::select('SELECT
								B.nombre as bank_name, B.imagen as banck_img, B.sps,
								T.nombre as card_name, T.cod_decidir, T.imagen as card_img,
								C.tarjeta_codigo, C.banco_id, C.coeficiente
							FROM
								bancos B
							LEFT JOIN
								cuotas C ON C.banco_id = B.id
							LEFT JOIN
								tarjetas T ON T.codigo = C.tarjeta_codigo
							WHERE
								C.cantidad_cuotas='.$sharesAmount.$coefficient.$bankId.'
							GROUP BY
								C.banco_id, C.tarjeta_codigo
							ORDER BY
								B.orden');
		//
		$banco_id = $rows[0]->banco_id;
		$creditCards = [];
		foreach($rows as $key => $item) {
			if ($banco_id != $item->banco_id) {
				$creditCards=[];
				$banco_id = $item->banco_id;
			};
			//
			$creditCards[$item->tarjeta_codigo] = [
				'nombre'    => $item->card_name,
				'code'      => $item->cod_decidir,
				'coef'      => $item->coeficiente,
				'img'       => $item->card_img
			];
			$PaymentOption['paymentCombo'][$item->banco_id] = [
				'banco'=>[
					'banco_id'      => $item->banco_id,
					'banco_imagen'  => str_replace('img/',"",$item->banck_img),
					'nombre'        => $item->bank_name,
					'sps'           => $item->sps,
					'tarjetas'      => array_values($creditCards)
				]
			];
		}
		$PaymentOption['paymentCombo'] = array_values($PaymentOption['paymentCombo']);
/**

#print_pre('SELECT B.nombre, B.imagen, B.sps, C.banco_id FROM bancos B LEFT JOIN cuotas C ON C.banco_id = B.id WHERE C.cantidad_cuotas = '.$sharesAmount.$coefficient.$bankId.' GROUP BY C.banco_id ORDER BY B.orden');
		$rowsBanks = DB::select('SELECT B.nombre, B.imagen, B.sps, C.banco_id FROM bancos B LEFT JOIN cuotas C ON C.banco_id = B.id WHERE C.cantidad_cuotas = '.$sharesAmount.$coefficient.$bankId.' GROUP BY C.banco_id ORDER BY B.orden');
		//
		foreach($rowsBanks as $bank)
		{
#print_pre('SELECT T.nombre, T.cod_decidir, T.imagen, C.coeficiente FROM tarjetas T LEFT JOIN cuotas C ON T.codigo = C.tarjeta_codigo WHERE C.banco_id = '.$bank->banco_id.' AND C.cantidad_cuotas ='.$sharesAmount.$coefficient.' GROUP BY C.tarjeta_codigo');
			$rowsCreditCards = DB::select('SELECT T.nombre, T.cod_decidir, T.imagen, C.coeficiente FROM tarjetas T LEFT JOIN cuotas C ON T.codigo = C.tarjeta_codigo WHERE C.banco_id = '.$bank->banco_id.' AND C.cantidad_cuotas ='.$sharesAmount.$coefficient.' GROUP BY C.tarjeta_codigo');
			$creditCards= [];
			//
			foreach($rowsCreditCards as $key => $item) {
				$creditCards[$key]['nombre']= $item->nombre;
				$creditCards[$key]['code']  = $item->cod_decidir;
				$creditCards[$key]['coef']  = $item->coeficiente;
				$creditCards[$key]['img']   = $item->imagen;
			}
			$PaymentOption['paymentCombo'][]= [
				'banco'=>[
					'banco_id'              => $bank->banco_id,
					'banco_imagen'          => str_replace('img/',"",$bank->imagen),
					'nombre'                => $bank->nombre,
					'sps'                   => $bank->sps,
					'tarjetas'              => $creditCards
				]
			];
		}
**/
#print_pre($PaymentOption);
		return (object) $PaymentOption;
	}

	static function getPayment($tarjeta=0,$cuotas=0,$banco=0)
	{
		$payment = DB::select( 'SELECT
									coeficiente, coef_bonif_banco, T.nombre as nombre_tarjeta, T.imagen as imagen_tarjeta
								FROM
									cuotas C, bancos B, tarjetas T
								WHERE
									C.banco_id = B.id AND C.tarjeta_codigo = T.codigo AND T.cod_decidir = '.$tarjeta.' AND C.cantidad_cuotas = '.$cuotas.' AND C.banco_id = '.$banco
							);
		return $payment[0];
	}

	static function getCardCode($cod_decidir=0)
	{
		$cardCode = DB::select('SELECT
									codigo
								FROM
									tarjetas
								WHERE
									cod_decidir = '.$cod_decidir
							);
		if (true==empty($cardCode[0]->codigo)) {
			return "";
		}
		return $cardCode[0]->codigo;
	}
	static function getCardName($cod_decidir=0)
	{
		$cardName = DB::select('SELECT
									nombre
								FROM
									tarjetas
								WHERE
									cod_decidir = '.$cod_decidir
		);
		if (true == empty($cardName[0]->nombre)) {
			return "";
		}
		return $cardName[0]->nombre;
	}
	static function getBankName($id=0)
	{
		$bankName = DB::select( 'SELECT
									nombre
								FROM
									bancos
								WHERE
									id = '.$id
						);
		if (true==empty($bankName[0]->nombre)) {
			return "";
		}
		return $bankName[0]->nombre;
	}

	//  read form post data
	static function getFormData()
	{
		Request::setMethod('POST');
		self::$form = Request::all();
#print_pre(self::$form);
		//  Small helpers

		$dataPago                   = explode('-', self::$form['data-pago']);
		self::$form['data-pago']    = [
			'tarjeta'               => (false==empty($dataPago[0])) ? $dataPago[0] : 0,
			'sps'                   => (false==empty($dataPago[1])) ? $dataPago[1] : '99',
			'cuotas'                => (false==empty($dataPago[2])) ? $dataPago[2] : 0,
			'banco'                 => (false==empty($dataPago[3])) ? $dataPago[3] : 0
		];
		self::$form['selectedCard'] = self::getCardName(self::$form['data-pago']['tarjeta']);
		self::$form['selectedBank'] = self::getBankName(self::$form['data-pago']['banco']);
		self::$form['selectedBank'] = (self::$form['selectedBank'] == 'Otros Bancos') ? self::$form['selectedBank'] : 'Banco '.self::$form['selectedBank'];
		self::$form['ownCredit']    = (env('CREDITO_GARBARINO_ID') == self::$form['data-pago']['banco']) ? 1 : 0;
#print_pre(self::$form,0,0);
		/**
		INSURANCE = Array(
			[TotalAmount] => 323.93
			[selectedBank] => Banco
			[data-pago] => 1-00180412-12-2-
			[precioFinal] => 373
			[intereses] => 98
			[bonificacion] => 49
			[maxCargosGestion] => 0
			[descCargosGestion] => 0
			[coefDescuento] => 0
			[Installment] => 1
			[banco] => 2
			[card] => SeleccionÃ¡ una tarjeta
			[traveler] => Array (
				[0] => Array (
					[nombre] => Test 1
					[apellido] => Pasajero 1
					[dia_nac] => 1
					[mes_nac] => 1
					[anio_nac] => 1970
					[tipoDocumento] => DNI
					[numeroDocumento] => 1234567891
				)
				[1] => Array(
					[nombre] => Test 2
					[apellido] => Pasajero 2
					[dia_nac] => 2
					[mes_nac] => 2
					[anio_nac] => 1975
					[tipoDocumento] => DNI
					[numeroDocumento] => 1234567892
				)
			)
			[emergencyContactsInfo] => Array(
				[name] => Test
				[lastname] => Emergencia
				[phone] => 4787-7077
			)
			[provincia] => C
			[stateName] => Ciudad de Buenos Aires
			[localidad] => Buenos Aires
			[matchedCity] => 1
			[localityCode] => 20000
			[subdivision] => Buenos Aires
			[zipCode] => C1000
			[domicilio] => Av. Cabildo
			[altura] => 2025
			[piso] => 1
			[depto] => Al fondo
			[clave] => CUIL
			[cuil] => 23123456789
			[email] => it@garbarinoviajes.com.ar
			[telefono] => 4787-7077
			[comentarios] => PRUEBA DESDE DESARROLLO
			[condiciones] => on
			[GID] => 64624cfb-9bf9-4b5d-8d29-bad8ee5c5bbe
			[RID] => 43
			[tester] => tester
		)
		**/
	}

	static function storeBook($bookingId="",$payment_product_data=[],$payment_gateway_data=[],$payment_gulliver_data=[])
	{
		//
		$typeProd       = $payment_product_data['typeProd'];
		//
		PaymentProductDataModel::setData($payment_product_data);

		$payment_product_data_id = PaymentProductDataModel::store($bookingId);

		//
		$RQdecidir      = [];
		if (1 != $payment_gateway_data['uatp']) {
			$RQdecidir['noperacion']    = $bookingId;
			$RQdecidir['nrocomercio']   = self::$form['data-pago']['sps'];
			$RQdecidir['mediopago']     = self::$form['data-pago']['tarjeta'];
			$RQdecidir['monto']         = ceil($payment_gateway_data['totalAmount']).'00';
			$RQdecidir['EMAILCLIENTE']  = self::$form['email'];
			$RQdecidir['URLDINAMICA']   = config('services.pagos-online.url');
		}
	//	$cardCode = self::getCardCode(self::$form['data-pago']['tarjeta']);
		//  Setter
		PaymentGatewayDataModel::setData([
			'noperacion'                => $bookingId,
			'rq_decidir'                => json_encode($RQdecidir),
			'moneda'                    => 'ARS',
			'cuotas'                    => self::$form['data-pago']['cuotas'],
			'monto'                     => $payment_gateway_data['totalAmount'],
			'tarjeta'                   => self::$form['data-pago']['tarjeta'],
			'banco'                     => self::$form['data-pago']['banco'],
			'sps'                       => self::$form['data-pago']['sps'],
			'emailcomprador'            => self::$form['email'],
			'traffic'                   => "",
			'credPropio'                => self::$form['ownCredit'],
			'gastos_HTL'                => $payment_gateway_data['htl_gastos'],
			'gastos_financieros'        => $payment_gateway_data['gastosFinancieros'],
			'bonificacion'              => $payment_gateway_data['bonificacion'],
			'cargos_gestion'            => self::$form['maxCargosGestion'],
			'desc_cargos_gestion'       => self::$form['descCargosGestion'],
			'coef_descuento'            => self::$form['coefDescuento'],
			'uatp'                      => $payment_gateway_data['uatp'],
			'cambio'                    => $payment_gateway_data['cambio'],
			'fecha_pago'                => \date("Y-m-d H:i:s"),
			'rate'                      => ''
		]);
		$payment_gateway_data_id = PaymentGatewayDataModel::store($bookingId);

		//
		PaymentGulliverDataModel::setData($payment_gulliver_data);
		$payment_gulliver_data_id = PaymentGulliverDataModel::store($bookingId);

		// credito propio banco_id = 3
		if (1 == self::$form['ownCredit']) {
			//  unificacion de datos
			switch($typeProd) {
				case 'INSURANCE':
					$startDate  = $payment_product_data['dataProd']['dateFrom'];
					$clientName = self::$form['traveler'][0]['nombre'].' '.self::$form['traveler'][0]['apellido'];
				break;
/**
				case 'AIR':
					$startDate  = $departureDate;
					$clientName = $nombreCliente;
				break;

				case 'HTL':
					$startDate  = $llegada;
					$clientName = $nombreCliente;
				break;

				case 'PKG':
					$startDate  = $departureDate;
					$clientName = $nombreCliente;
				break;
**/
				default:
					$startDate  = "";
					$clientName = "";
					break;
			}
			self::GarbarinoCredit($bookingId,$startDate,$clientName);
		}
		unset($payment_product_data,$payment_gateway_data,$payment_gulliver_data);

		return [
			'payment_product_data_id'   => $payment_product_data_id,
			'payment_gateway_data_id'   => $payment_gateway_data_id,
			'payment_gulliver_data_id'  => $payment_gulliver_data_id
		];
	}

	static function GarbarinoCredit($bookingId="",$startDate="",$clientName="")
	{
		$variables  = [
			'STATICS'       => Controller::$static,
			'bookingId'     => $bookingId,
			'startDate'     => $startDate,
			'clientName'    => $clientName,
			'clave'         => self::$form['clave'],
			'cuil'          => self::$form['cuil'],
			'telefono'      => self::$form['telefono'],
////		'email'         => self::$form['email'],
			'email'         => 'leviatan21@hotmail.com',
			'cuotasQty'     => self::$form['data-pago']['cuotas'],
			'bancoName'     => self::getBankName(self::$form['data-pago']['banco']),
			'tarjetaName'   => self::getCardName(self::$form['data-pago']['tarjeta']),

			'from'          => env('MAIL_CONSULTA', 'ventas@garbarinoviajes.com.ar'),
			'fromName'      => 'Garbarino Viajes',
			'subject'       => 'Solicitud de cobro con crédito propio [RefID: '.$bookingId.']',
			'addCC'         => [
				'leviatan21@hotmail.com'
////			env('MAIL_CONSULTA', 'ventas@garbarinoviajes.com.ar')
			],
			'addBCC'        => [
				'leviatan21@gmail.com'
////			env('MAIL_CONSULTA_BCC', 'msuvia@proveedores.garbarino.com.ar')
			]
		];

		$sent = Mail::send('mails/emailCreditoPropio', $variables, function($message) use ($variables) {
			$message->subject($variables['subject']);
			$message->from($variables['from'], $variables['fromName']);
			$message->to($variables['email'], $variables['clientName']);
			$message->cc($variables['addCC']);
			$message->bcc($variables['addBCC']);
		});
		return $sent;
	}
}
