<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
	function __construct()
	{
		parent::__construct();
	//	self::getPayments();
	//	dd(__FILE__.':'.__LINE__);
	}

	static function displayCommons()
	{
		view()->share([
			'InstallmentsWOinterest'    => self::getInstallmentsWOinterest(),
			'InstallmentsWinterest'     => self::getInstallmentsWinterest(),
			'InstallmentsOtherBanks'    => self::getInstallmentsOtherBanks(),
			'InstallmentsUatp'          => self::getInstallmentsUatp(),
			'Nationalities'             => self::getNationalities(),
			'Months'                    => self::getMonths()
		]);
	}

	static function getPayments()
	{
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
		$nationalities = (array) DB::select('SELECT cod_pais, descripcion FROM paises ORDER BY descripcion');
		return $nationalities;
	}

	//  cuotas sin interes
	static function getInstallmentsWOinterest()
	{
		$Installments = (array) DB::select('SELECT cantidad_cuotas FROM cuotas WHERE coeficiente = 0 AND cantidad_cuotas != 1 AND banco_id != 15 GROUP BY cantidad_cuotas ORDER BY cantidad_cuotas DESC ');
		//
		$options=[];
		foreach ($Installments as $Installment) {
			$optionPayment = self::getOption($Installment, true, false);
			$options[] = $optionPayment;
		}
		return $options;
	}

	//  cuotas con interes
	static function getInstallmentsWinterest()
	{
		$Installments = (array) DB::select('SELECT cantidad_cuotas FROM cuotas WHERE cantidad_cuotas != 1 AND coeficiente != 0 AND banco_id != 15  GROUP BY cantidad_cuotas ORDER BY cantidad_cuotas DESC ');
		$options=[];
		foreach ($Installments as $Installment) {
			$optionPayment = self::getOption($Installment, false, false);
			$options[] = $optionPayment;
		}
		return $options;
	}

	//  otros bancos
	static function getInstallmentsOtherBanks()
	{
		$whereCantidad = '';
		if (defined('uatpAirlineCode')) {
			$whereCantidad = " AND cantidad_cuotas != 1 ";
		}
		$Installments = (array) DB::select('SELECT cantidad_cuotas FROM cuotas WHERE  banco_id = 15 '.$whereCantidad.' GROUP BY cantidad_cuotas ORDER BY cantidad_cuotas ASC ');
		$options=[];
		foreach ($Installments as $Installment) {
			$optionPayment = self::getOption($Installment, false, true);
			$options[] = $optionPayment;
		}
		return $options;
	}

	//  UATP
	static function getInstallmentsUatp()
	{
		$options=[];
		return $options;
	}

	static function getOption($cuota, $interes, $all)
	{
		$optionPayment = new paymentOption;
		$optionPayment->setCuotas($cuota->cantidad_cuotas);
		if ($interes == true && $all == false) {
			$coeficent = ' AND C.coeficiente = 0';
			$bankId = ' AND banco_id != 15';
		} elseif($interes == false && $all == false) {
			$coeficent = ' AND C.coeficiente != 0';
			$bankId = ' AND banco_id != 15';
		}else{
			$coeficent = '';
			$bankId = ' AND banco_id = 15';
		}
		//
		$bancos = DB::select('SELECT B.nombre, C.banco_id , B.imagen , B.sps FROM bancos B JOIN cuotas C ON C.banco_id = B.id WHERE C.cantidad_cuotas = '. $cuota->cantidad_cuotas . $coeficent .''.$bankId.' GROUP BY C.banco_id ORDER BY B.orden ');
		//
		foreach($bancos as $banco)
		{
			$tarjetasQuery = DB::select('SELECT T.nombre, T.cod_decidir, C.coeficiente, T.imagen  FROM tarjetas T JOIN cuotas C ON T.codigo = C.tarjeta_codigo WHERE C.banco_id =' . $banco->banco_id . ' AND C.cantidad_cuotas =' . $cuota->cantidad_cuotas . $coeficent .'  GROUP BY C.tarjeta_codigo ');
			$tarjetas = array();
			foreach($tarjetasQuery as $key=>$tarjeta) {
				$tarjetas[$key]['nombre'] =  $tarjeta->nombre;
				$tarjetas[$key]['code']   =  $tarjeta->cod_decidir;
				$tarjetas[$key]['coef']   =  $tarjeta->coeficiente;
				$tarjetas[$key]['img']    =  $tarjeta->imagen;
			}
			$optionPayment->createCombo($banco, $tarjetas);
		}
		return $optionPayment;
	}
}

class paymentOption
{
	public $cuotas;
	public $paymentCombo;

	public function createCombo($banco, $tarjetas)
	{
		$combo = array();
		$combo['banco'] = array();
		$combo['banco']['banco_id']     = $banco->banco_id;
		$combo['banco']['banco_imagen'] = $banco->imagen;
		$combo['banco']['nombre']       = $banco->nombre;
		$combo['banco']['sps']          = $banco->sps;
		$combo['banco']['tarjetas']     = $tarjetas;
		$this->paymentCombo[] = $combo;
	}

	/**
	 * @return array
	 */
	public function getPaymentCombo()
	{
		return $this->paymentCombo;
	}

	/**
	 * @param array $paymentCombo
	 */
	public function setPaymentCombo($paymentCombo)
	{
		$this->paymentCombo = $paymentCombo;
	}

	/**
	 * @return mixed
	 */
	public function getCuotas()
	{
		return $this->cuotas;
	}

	/**
	 * @param mixed $cuotas
	 */
	public function setCuotas($cuotas)
	{
		$this->cuotas = $cuotas;
	}
}