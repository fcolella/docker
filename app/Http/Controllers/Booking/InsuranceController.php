<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Booking;
use App\Http\Controllers\Gulliver;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Insurance\InsuranceModel;

/**
 * Class InsuranceController
 * @package App\Http\Controllers\Booking
 */
class InsuranceController extends BookingController
{
	static $search = false;
	static $item = false;
	static $testPNR = true;
	static $response = false;
	static $settings = [
		'maxAge'	 => 86
	];

	function __construct()
	{
		parent::__construct();
	}

	//  http://viajes-laravel.dev/compra/seguros?GID=0aae559b-f84b-480e-8c88-4efab51b3c7e&RID=4
	function Index()
	{
		self::getParameters();
		if (false===self::$search || false==self::$item) {
			abort(404);
		}
		//
		BookingController::displayCommons( self::$item['insuranceTotalPrices']['requestedSellingPrice']['afterTax'] );
		//
		$yearTo         = explode('-', self::$search['dateTo']);
		$topYear        = self::$settings['maxAge'] - ($yearTo[0] - date('Y'));
		//
		self::addJsFooter('Insurance/Booking.js');
		return view('booking.Index')
		->with([
			'title'             => 'Comprá ON-LINE tu asistencia al viajero en '.mb_convert_case(self::$search['destination'],MB_CASE_TITLE,'UTF-8'),
			'infoPlan'          => self::$item,
			'search'            => self::$search,
			'currentYear'       => (int) date('Y'),
			'topYear'           => (int) $topYear,
			//
			'includes'          => [
				'main'          => [
					'booking.Insurance.Passengers',
					'booking.Emergency',
					'booking.Billing',
					'booking.Contact'
				],
				'sidebar'       => [
					'booking.Insurance.Information'
				]
			],
			//  Booking steps
			'time1'             => 'present',
			'time2'             => '',
			'time3'             => ''
		]);
	}

	function Submit()
	{
		self::getParameters();
		if (false===self::$search || false==self::$item) {
			abort(404);
		}
		//  read form post data
		BookingController::getFormData();
		//  do the book against Gulliver
		self::bookGet();
#print_pre(self::$response);
		//  Store the book into the DB
		self::bookStore();
	}

	static function getParameters()
	{
		Request::setMethod('GET');
		$gulliver_sessionId = Request::get('GID',"");
		$database_id        = Request::get('RID',"");
		if (""==$gulliver_sessionId) {
			return false;
		}
		if (""==$database_id) {
			return false;
		}
		//
		$row = InsuranceModel::where('session', $gulliver_sessionId)->where('id', $database_id)->first()->toArray();
		self::$search  = json_decode($row['search'],true);
		self::$item    = json_decode($row['item'],true);
		unset($row);
	}

	static function bookGet()
	{
		//  Prepare Purchase Passengers
		$paxLead="";
		$coveredTravelers = [];
		foreach(self::$form['traveler'] as $key => $traveler) {
			$isLead = false;
			if (0==$key) {
				$isLead = true;
				$paxLead = $traveler['nombre'].' '.$traveler['apellido'];
			}
			$coveredTravelers[] = [
				'email'         => "",
				'code'          => 'ADT',
				'documents'     => [
					[
						'docType'   => $traveler['tipoDocumento'],
						'docId'     => $traveler['numeroDocumento'],
						'primary'   => true
					]
				],
				'lastName'      => $traveler['apellido'],
				'firstName'     => $traveler['nombre'],
				'birthDate'     => dateFormat($traveler['anio_nac'].'-'.$traveler['mes_nac'].'-'.$traveler['dia_nac'],'Y-m-d'),
				'isLead'        => $isLead
			];
		}
		view()->share('paxLead',$paxLead);
		// Prepare Purchase Parameters
		$GulliverParameters = [
			'purchaseComments'          => self::$form['comentarios'].' | Datos de fact:'.self::$form['domicilio'].' '.self::$form['altura'].' '.self::$form['piso'].' '.self::$form['depto'].' ('.self::$form['localidad'].')-'.self::$form['clave'].':'.self::$form['cuil'],
			'dateTo'                    => self::$search['dateTo'],
			'onlinePurchase'            => true,
			'contactInfo'               => [
				'firstName'             => $coveredTravelers[0]['firstName'],
				'lastName'              => $coveredTravelers[0]['lastName'],
				'email'                 => self::$form['email'],
				'telephones'            => [
					[
						'telephoneType' => 'Home',
						'phoneNumber'   => self::$form['telefono']
					]
				]
			],
			'emergencyContactsInfo'     => [
				[
					'firstName'             => self::$form['emergencyContactsInfo']['name'],
					'lastName'              => self::$form['emergencyContactsInfo']['lastname'],
					'email'                 => '',
					'telephones'            => [
						[
							'telephoneType' => 'Home',
							'phoneNumber' 	=> self::$form['emergencyContactsInfo']['phone']
						]
					]
				]
			],
			'sessionId'                 => self::$form['GID'],
			'dateFrom'                  => self::$search['dateFrom'],
			'isPromotion'               => false,
		//	'tripFileRefCode'           => '',
			'requestedCurrency'         => self::$item['insuranceTotalPrices']['requestedPromotionalPrice']['currency'],
			'purchasedPlans'            => [
				[
					'purchasePlanCode'  => self::$item['insurancePlan']['code'],
					'coveredTravelers'  => $coveredTravelers,
					'coveredDestination'=> mb_convert_case(self::$search['destination'],MB_CASE_TITLE)
				]
			]
		];
#print_pre( json_encode($GulliverParameters),0,1 );
		//   For testing proposes
		if (false==self::$testPNR) {
			$resp = Gulliver::BookingInsurance($GulliverParameters);
		} else {
			$resp = '{"data":{"dateTo":"2016-01-16","success":true,"bookingId":"N7IZZA","coveredTravelersCount":2,"sessionId":"64624cfb-9bf9-4b5d-8d29-bad8ee5c5bbe","dateFrom":"2016-01-15","requestedCurrency":"ARS","purchasedPlans":[{"insurancePlan":{"insuranceProvider":"TVA","name":"EuropeEUR30.000","description":"Europe30.000Euros","tripType":"SINGLE_TRIP","validTo":"2016-09-30T03:00:00Z","validFrom":"2013-10-01T03:00:00Z","code":"EUR30K","quotingUnit":"PER_DAY"},"coverages":[{"coverage":{"code":"CODE1","name":"AsistenciamÃƒÂ©dicaencasodeenfermedad","order":1.00,"priority":false},"detail":"HastaEUR30.000"},{"coverage":{"code":"CODE2","name":"AsistenciamÃƒÂ©dicaencasodeaccidente","order":2.00,"priority":false},"detail":"HastaEUR30.000"},{"coverage":{"code":"CODE3","name":"AsistenciamÃƒÂ©dicaencasodepre-existencia","order":3.00,"priority":false},"detail":"HastaEUR300"},{"coverage":{"code":"CODE4","name":"MedicamentosInternaciÃƒÂ³noAmbulatorio","order":4.00,"priority":false},"detail":"HastaEUR1.000"},{"coverage":{"code":"CODE5","name":"OdontologÃƒÂ­a","order":5.00,"priority":false},"detail":"HastaEUR250"},{"coverage":{"code":"CODE6","name":"DÃƒÂ­ascomplementariosporinternaciÃƒÂ³n","order":6.00,"priority":false},"detail":"2dÃƒÂ­as"},{"coverage":{"code":"CODE8","name":"SegurodeAccidentesPersonalesencasodemuerteaccidentalentrasportepÃƒÂºblico","order":8.00,"priority":false},"detail":"HastaUSD60.000"},{"coverage":{"code":"CODE9","name":"CompensaciÃƒÂ³nporpÃƒÂ©rdidadeequipajecomplementaria","order":9.00,"priority":false},"detail":"HastaEUR1.200"},{"coverage":{"code":"CODE11","name":"Gastosdehotelporconvalecencia","order":11.00,"priority":false},"detail":"HastaEUR500"},{"coverage":{"code":"CODE12","name":"GastosdehotelfamiliaracompaÃƒÂ±ante","order":12.00,"priority":false},"detail":"HastaEUR500"},{"coverage":{"code":"CODE13","name":"Anticipodefondosparafianza","order":13.00,"priority":false},"detail":"HastaEUR10.000"},{"coverage":{"code":"CODE14","name":"Transferenciadefondos","order":14.00,"priority":false},"detail":"HastaEUR2.000"},{"coverage":{"code":"CODE16","name":"GarantÃƒÂ­agastoscancelaciÃƒÂ³n/interrupciÃƒÂ³nc/restricciÃƒÂ³ndecausas(h/75aÃƒÂ±os)","order":16.00,"priority":false},"detail":"HastaEUR1.000"},{"coverage":{"code":"CODE17","name":"LocalizaciÃƒÂ³ndeequipaje","order":17.00,"priority":false},"detail":"Incluido"},{"coverage":{"code":"CODE18","name":"TrasladodefamiliarencasodehospitalizaciÃƒÂ³n","order":18.00,"priority":false},"detail":"Incluido"},{"coverage":{"code":"CODE19","name":"AsistenciaencasodeextravÃƒÂ­odedocumentos","order":19.00,"priority":false},"detail":"Incluido"},{"coverage":{"code":"CODE20","name":"AcompaÃƒÂ±amientodemenores","order":20.00,"priority":false},"detail":"Incluido"},{"coverage":{"code":"CODE21","name":"Viajederegresoporenfermedaddeltitular","order":21.00,"priority":false},"detail":"Incluido"},{"coverage":{"code":"CODE22","name":"Trasladosanitario","order":22.00,"priority":false},"detail":"Incluido"},{"coverage":{"code":"CODE23","name":"RepatriaciÃƒÂ³nsanitaria(incluidodentrodellÃƒÂ­mitedeasistenciamÃƒÂ©dica)","order":23.00,"priority":false},"detail":"Incluido"},{"coverage":{"code":"CODE24","name":"Trasladoderestos(incluidodentrodellÃƒÂ­mitedeasistenciamÃƒÂ©dica)","order":24.00,"priority":false},"detail":"Incluido"},{"coverage":{"code":"CODE25","name":"TransmisiÃƒÂ³ndemensajesurgentes","order":25.00,"priority":false},"detail":"Incluido"},{"coverage":{"code":"CODE26","name":"LÃƒÂ­neadeconsultas24hs","order":26.00,"priority":false},"detail":"Incluido"},{"coverage":{"code":"CODE27","name":"CÃƒÂºmuloporevento,accidenteconmÃƒÂºltiplesTitulares,aprorrata","order":27.00,"priority":false},"detail":"HastaEUR150.000"}],"insuranceTotalPrices":{"requestedPromotionalPrice":{"beforeTax":233.96,"afterTax":239.01,"currency":"ARS","taxes":[{"rate":0.105,"baseAmount":47.41,"name":"IVAGravadoal10.5%","amount":5.05,"code":"GRAVADO105","currencyCode":"ARS"}]},"requestedSellingPrice":{"beforeTax":310.91,"afterTax":324.12,"currency":"ARS","taxes":[{"rate":0.105,"baseAmount":124.36,"name":"IVAGravadoal10.5%","amount":13.21,"code":"GRAVADO105","currencyCode":"ARS"}]},"sellingPrice":{"beforeTax":16.00,"afterTax":16.68,"currency":"USD","taxes":[{"rate":0.105,"baseAmount":6.40,"name":"IVAGravadoal10.5%","amount":0.68,"code":"GRAVADO105","currencyCode":"USD"}]},"costPrice":{"beforeTax":9.60,"afterTax":9.60,"currency":"USD","taxes":[]},"currencyConversion":{"rateConversion":19.43,"requestedCurrency":"ARS","sourceCurrency":"USD"},"promotionalPrice":{"beforeTax":12.04,"afterTax":12.30,"currency":"USD","taxes":[{"rate":0.105,"baseAmount":2.44,"name":"IVAGravadoal10.5%","amount":0.26,"code":"GRAVADO105","currencyCode":"USD"}]}},"insurancePassengerPrice":[{"requestedPromotionalPrice":{"beforeTax":116.98,"afterTax":119.50,"currency":"ARS","taxes":[{"rate":0.105,"baseAmount":23.71,"name":"IVAGravadoal10.5%","amount":2.53,"code":"GRAVADO105","currencyCode":"ARS"}]},"requestedSellingPrice":{"beforeTax":155.45,"afterTax":162.06,"currency":"ARS","taxes":[{"rate":0.105,"baseAmount":62.18,"name":"IVAGravadoal10.5%","amount":6.61,"code":"GRAVADO105","currencyCode":"ARS"}]},"travelerAge":46,"sellingPrice":{"beforeTax":8.00,"afterTax":8.34,"currency":"USD","taxes":[{"rate":0.105,"baseAmount":3.20,"name":"IVAGravadoal10.5%","amount":0.34,"code":"GRAVADO105","currencyCode":"USD"}]},"costPrice":{"beforeTax":4.80,"afterTax":4.80,"currency":"USD","taxes":[]},"currencyConversion":{"rateConversion":19.43,"requestedCurrency":"ARS","sourceCurrency":"USD"},"promotionalPrice":{"beforeTax":6.02,"afterTax":6.15,"currency":"USD","taxes":[{"rate":0.105,"baseAmount":1.22,"name":"IVAGravadoal10.5%","amount":0.13,"code":"GRAVADO105","currencyCode":"USD"}]}},{"requestedPromotionalPrice":{"beforeTax":116.98,"afterTax":119.50,"currency":"ARS","taxes":[{"rate":0.105,"baseAmount":23.71,"name":"IVAGravadoal10.5%","amount":2.53,"code":"GRAVADO105","currencyCode":"ARS"}]},"requestedSellingPrice":{"beforeTax":155.45,"afterTax":162.06,"currency":"ARS","taxes":[{"rate":0.105,"baseAmount":62.18,"name":"IVAGravadoal10.5%","amount":6.61,"code":"GRAVADO105","currencyCode":"ARS"}]},"travelerAge":40,"sellingPrice":{"beforeTax":8.00,"afterTax":8.34,"currency":"USD","taxes":[{"rate":0.105,"baseAmount":3.20,"name":"IVAGravadoal10.5%","amount":0.34,"code":"GRAVADO105","currencyCode":"USD"}]},"costPrice":{"beforeTax":4.80,"afterTax":4.80,"currency":"USD","taxes":[]},"currencyConversion":{"rateConversion":19.43,"requestedCurrency":"ARS","sourceCurrency":"USD"},"promotionalPrice":{"beforeTax":6.02,"afterTax":6.15,"currency":"USD","taxes":[{"rate":0.105,"baseAmount":1.22,"name":"IVAGravadoal10.5%","amount":0.13,"code":"GRAVADO105","currencyCode":"USD"}]}}]}]},"audit":{"serverName":"gulliverdesa1","schemaRelease":"2012-05-2.16","productVersion":"master-InternalVersion","serverIp":"10.0.1.38","processTime":3262}}';
		}
		//	Check response
		if (false === $resp && true === Gulliver::$error) {
			return false;
		}
		//	Decode the response
		$response=json_decode($resp,true);
		//	Check for json error
		if (json_last_error() != JSON_ERROR_NONE)
		{
			return false;
		} else {
			unset($resp);
		}
		if (true == empty($response['data']['success'])) {
			return false;
		}
#print_pre($response, 0, 1);
		self::$response = $response['data'];
		unset($response);
		return true;
	}

	static function bookStore()
	{
		$bookingId              = self::$response['bookingId'];
		//
		$cambio                 = 1;
		$uatp                   = (false==empty(self::$form['uatp'])) ? self::$form['uatp'] : 0;
		$htl_gastos             = (false==empty(self::$form['htl_gastos'])) ? self::$form['htl_gastos'] : 0;
		$confirmData            = (false==empty(self::$form['confirmData'])) ? self::$form['confirmData'] : "";
		$cargosGestion          = 0;
		$descCargosGestion      = 0;
		$totalIns               = self::$response['purchasedPlans'][0]['insuranceTotalPrices']['requestedSellingPrice']['afterTax'];
		$payment                = BookingController::getPayment(self::$form['data-pago']['tarjeta'], self::$form['data-pago']['cuotas'], self::$form['data-pago']['banco']);
		$payment_try            = (1 != $htl_gastos) ? 1 : 0;
		$precioParcial          = $totalIns + $cargosGestion - $descCargosGestion;
		$gastosFinancieros      = ceil($precioParcial * $payment->coeficiente);
		$bonificacion           = ceil($gastosFinancieros * $payment->coef_bonif_banco);
		$totalAmount            = ceil($precioParcial + $gastosFinancieros - $bonificacion);
		//
		view()->share([
			'form'              => self::$form,
			'search'            => self::$search,
			'product'           => self::$response,
			'totalAmount'       => $totalAmount,
			'creditCardImage'   => $payment->imagen_tarjeta,
			'creditCardName'    => $payment->nombre_tarjeta
		]);
#print_pre( self::$form );
#print_pre( self::$search );
#print_pre( self::$response );
#$BodyMailCompra = view('Insurance/compra-ok')->render();
#print_r($BodyMailCompra);die();
		//  Prepare data for store in 'payment_product_data'
		$payment_product_data   = [
			'typeProd'          => 'INSURANCE',
			'dataProd'          => [
				'TotalIns'      => ceil($totalIns),
				'intereses'     => $gastosFinancieros,
				'bonificacion'  => $bonificacion,
				'cargos'        => self::$form['maxCargosGestion'] - self::$form['descCargosGestion'],
				'TotalAmount'   => $totalAmount,
				'currency'      => self::$response['purchasedPlans'][0]['insuranceTotalPrices']['requestedSellingPrice']['currency'],
				'qPax'          => self::$response['coveredTravelersCount'],
				'destination'   => mb_convert_case(self::$search['destination'],MB_CASE_TITLE,'UTF-8'),
				'dateFrom'      => self::$search['dateFrom'],
				'dateTo'        => self::$search['dateTo'],
				'prodDescription'=> self::$response['purchasedPlans'],
				'userPostData'  => self::$form
			],
			'TempateOk'         => view('Insurance/compra-ok')->render(),
			'BodyMailReserva'   => "",
			'BodyMailCompra'    => view('Insurance/mails/compra-ok')->render()
		];

		//  Prepare data for store in 'payment_gateway_data'
		$payment_gateway_data   = [
			'uatp'              => $uatp,
			'htl_gastos'        => $htl_gastos,
			'bookingId'         => $bookingId,
			'totalAmount'       => $totalAmount,
			'gastosFinancieros' => $gastosFinancieros,
			'bonificacion'      => $bonificacion,
			'cambio'            => $cambio
		];

		//   Prepare data for store in 'payment_gulliver_data'
		$payment_gulliver_data  = [
			'gastos_HTL'        => $htl_gastos,
			'payment_try'       => $payment_try,
			'email_reserva'     => self::$form['email'],
			'analitycs_data'    => json_encode([
				'bookingId'     => $bookingId,
				'productName'   => 'INSURANCE',
				'prod'          => self::$response['purchasedPlans'][0]['insurancePlan']['name'],
				'proov'         => self::$response['purchasedPlans'][0]['insurancePlan']['insuranceProvider'],
				'total'         => $totalAmount,
				'pax'           => self::$response['coveredTravelersCount']
			]),
			'confirm_data'      => $confirmData
		];

		//  Finally send all to be stored
		BookingController::storeBook($bookingId, $payment_product_data, $payment_gateway_data, $payment_gulliver_data);
print_pre($bookingId);
		//
		return redirect('http://www.garbarinoviajes.com.ar/pago-online/pago-confirma.php?refId='.$bookingId)->send();
	}
}