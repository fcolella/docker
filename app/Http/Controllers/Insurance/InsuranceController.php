<?php
/**
 * @todo purge results from db
**/
namespace App\Http\Controllers\Insurance;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\URL;
use Jaybizzle\Safeurl\Facades\Safeurl;
use App\Http\Controllers\Gulliver;
use App\Http\Controllers\Insurance\InsuranceModel;

/**
 * Class InsuranceController
 * @package App\Http\Controllers\Insurance
 */
class InsuranceController extends Controller
{
	//  Settings
	protected static $enabled = true;
	private static $config = [
		'cookieName'		=> 'IS',
		'cookieTtl'			=> 54000,	//	15 Days
		'mindate'			=> '+3d',	//	days
		'maxdate'			=> '+12m', 	//	months
		'maxPassengers'     => 9,
		'maxAge'			=> 86,
		'pagination'		=> 10,
		//  Zoneslanding
		'delay'             => 3,
		'duration'          => 21,      //  Cantidad de dias que se muestra al cliente
	];

	/**
	 *
	**/
	function __construct()
	{
	//	$form = Request::all(); print_pre($form,0,0);
		if (false == self::$enabled) {
			return redirect(URL::to('/'),302)->send();
		}
		parent::__construct();
		//  Add css and js
		if (false==Request::ajax()) {
			Controller::addCss('Insurance/stylesheet.css');
			Controller::addJsFooter('lib/jquery.validate.js');
			Controller::addJsFooter('Insurance/SearchBox.js');
		}
		//  get search zones from Gulliver
		$availableGeoZones = Gulliver::getInsurancesFilters();
		//  Common search form
		view()->share([
			'InsuranceSearch'	    => Cookie::get(self::$config['cookieName']),
			'InsuranceZones'	    => (false==empty($availableGeoZones['availableGeoZones'])) ? $availableGeoZones['availableGeoZones'] : [],
			'InsuranceConfig'       => self::$config
		]);
		unset($availableGeoZones);
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	**/
	public function index()
	{
		self::addJsFooter('jquery/jquery.colorbox-min.js');
		self::addJsFooter('funciones.js');
		self::addJsFooter('lib/owl.carousel.min.js');
		self::addJsFooter('main.js');
		return view(
			'Insurance/index'
		)->with([
			'HomeSearchSliders'     => Controller::getSearchSliders('insurance'),
			'BanksSliders'			=> Controller::getBanks('slider'),
			'DestinationsSliders'	=> Controller::getDestinations('slider')
		]);
	}

	/**
	 *
	**/
	public function zones()
	{
		$availableGeoZones = Gulliver::getInsurancesFilters();
		if (true == empty($availableGeoZones['availableGeoZones'])) {
			return redirect('/seguros')->send();
		}
		//
		$destiny = $gulliverDestiny = Request::get('destino', "");
		if ('All' == $destiny || "" == $destiny) {
			$duration = 15;
			$gulliverDestiny = 'America';
		} else if ('Argentina' == $destiny) {
			$duration = 7;
		} else {
			$duration = self::$config['duration'];
		}
		$today      = new \DateTime();
		$dateFrom   = $today->add(new \DateInterval('P' . (self::$config['delay']) . 'D'))->format('Y-m-d');
		$dateTo     = $today->add(new \DateInterval('P' . ($duration - 1) . 'D'))->format('Y-m-d');
		//
		$response = Gulliver::getInsuranceAvailability([
			'origin' => 'BUE',
			'destination' => mb_convert_case($gulliverDestiny, MB_CASE_TITLE),
			'dateFrom' => $dateFrom,
			'dateTo' => $dateTo,
			'passengers' => '1',
			'currency' => 'ARS'
		]);
		//
		if (false == $response || true == empty($response['availablePlans'])) {
			return redirect('/seguros')->send();
		}
		//
		switch ($destiny) {
			case 'Europa':
				$zoneData = [
					'image' => 'seguros/europa.jpg',
					'title' => 'Europa',
					'text'  => 'Desde el 2001 se encuentra en vigencia el "Tratado Schengen" que estipula la necesidad de contar con un seguro de viaje
								para poder ingresar a los 28 paises que lo componen (Alemania, Austria, Bélgica, Bulgaria, Chipre, Dinamarca, Eslovaquia,
								Eslovenia, España, Estonia, Finlandia, Francia, Grecia, Holanda, Hungría, Islandia, Italia, Letonia, Lituania, Luxemburgo,
								Malta, Noruega, Polonia, Portugal, República Checa, Rumania, Suecia y Suiza).'
				];
			break;
			case 'Argentina';
				$zoneData = [
					'image' => 'seguros/argentina.jpg',
					'title' => 'Argentina',
					'text'  => 'Ante eventuales problemas de salud, pérdida de equipaje, pasaporte o documentos, un simple llamado telefónico pone en
								funcionamiento el m&aacute;s avanzado sistema de asistencias para solucionar todos los inconvenientes.
								Disfrutá de tu viaje con la tranquilidad de viajar seguro.'
				];
			break;
			case 'Asia':
				$zoneData = [
					'image' => 'seguros/asia.jpg',
					'title' => 'Asia',
					'text'  => 'Viajá seguro con nuestra garantía de confianza. Ante eventuales problemas de salud, pérdida de equipaje, pasaporte o
								documentos, un simple llamado telefónico pone en funcionamiento el más avanzado sistema de asistencias para solucionar todos
								los inconvenientes.
								Disfrutá de tu viaje con la tranquilidad de viajar seguro.'
				];
			break;
			case 'Africa':
				$zoneData = [
					'image' => 'seguros/africa.jpg',
					'title' => 'Africa',
					'text'  => 'Viajá seguro con nuestra garantía de confianza. Ante eventuales problemas de salud, pérdida de equipaje, pasaporte o
								documentos, un simple llamado telefónico pone en funcionamiento el más avanzado sistema de asistencias para solucionar todos
								los inconvenientes.
								Disfrutá de tu viaje con la tranquilidad de viajar seguro.'
				];
			break;
			case 'America':
				$zoneData = [
					'image' => 'seguros/america.jpg',
					'title' => 'América',
					'text'  => 'Viajá seguro con nuestra garantía de confianza. Ante eventuales problemas de salud, pérdida de equipaje, pasaporte o
								documentos, un simple llamado telefónico pone en funcionamiento el más avanzado sistema de asistencias para solucionar todos
								los inconvenientes.
								Disfrutá de tu viaje con la tranquilidad de viajar seguro.'
				];
			break;
			default:
				$zoneData = [
					'image' => 'seguros/otros.png',
					'title' => "Cualquier lugar del mundo",
					'text'  => 'Viajá seguro con nuestra garantía de confianza. Ante eventuales problemas de salud, pérdida de equipaje, pasaporte o
								documentos, un simple llamado telefónico pone en funcionamiento el más avanzado sistema de asistencias para solucionar todos
								los inconvenientes.
								Disfrutá de tu viaje con la tranquilidad de viajar seguro.'
				];
			break;
		}
		//
		$Plans = [];
		foreach ($response['availablePlans'] as $key_plan => $plan) {
			$Plans['insurancePlan'][] = array_merge($plan['insurancePlan'],[
				'duration'      => $duration,
				'currency'      => $plan['insuranceTotalPrices']['requestedSellingPrice']['currency'],
				'afterTax'      => $plan['insuranceTotalPrices']['requestedSellingPrice']['afterTax']
			]);
			foreach($plan['coverages'] as $key_coverage => $coverage) {
				$Plans['coverages'][ $coverage['coverage']['code'] ][] = [
					'name'      => $coverage['coverage']['name'],
					'detail'    => $coverage['detail']
				];
			}
		}
		//
		Controller::$route = 'insurance-results';
		return view('Insurance/landing-zones')
		->with([
			'Plans'     => $Plans,
			'zoneData'  => $zoneData,
		]);
	}

	/**
	 * @return \Symfony\Component\HttpFoundation\Response
	**/
	public function search()
	{
		Request::setMethod('POST');
		$search = [
			'origen'		=> mb_convert_case(Request::get('origin',""),MB_CASE_LOWER),
			'destino'	    => Request::get('destination',""),
			'fecha-desde'	=> dateFormat(Request::get('dateFrom',"")),
			'fecha-hasta'	=> dateFormat(Request::get('dateTo',"")),
			'pasajeros'	    => self::passengersParseForm()
		];
	//	$destination		= Request::get('destination',"");
	//	$redirect = URL::to('/seguros/listado-de-seguros-en-'. Safeurl::make($destination)).'/?'.http_build_query($search);
		$redirect = URL::to('/seguros/listado-de-seguros/?'.http_build_query($search));
		return redirect($redirect)->send();
	}

	/**
	 * @return $this
	**/
	public function results()
	{
		$parameters = self::validateParams();
		Controller::$route = 'insurance-results';
		Controller::addJsFooter('Insurance/Results.js');
		//
		return view('Insurance/results')->with([
			'ResultTitle'		=> sprintf(' Seguros en %1s', $parameters['search']['destination']),
			'LoaderPrimary'		=> sprintf('Buscando seguros en %1s', $parameters['search']['destination']),
			'LoaderSecundary'	=> sprintf('del %1s al %2s', date('d/m/Y', strtotime($parameters['search']['dateFrom'])), date('d/m/Y', strtotime($parameters['search']['dateTo']))),
			'InsuranceErrors'	=> $parameters['errors'],
			'InsuranceSearch'	=> $parameters['search'],
			'InsuranceGridUri'	=> URL::to('/seguros/grilla?search='.Crypt::encrypt($parameters['search']))
		]);
	}

	/**
	 * @return mixed
	**/
	public function grid()
	{
		$EncryptedSearch = Request::get('search',"");
		if (""==$EncryptedSearch) {
			return Response::json(['error'=>true,'description'=>'No search'],412);
		}
		//
		try {
			$search = Crypt::decrypt($EncryptedSearch);
		} catch (\Exception $e) {
			return Response::json(['error'=>true,'description'=>'Search decode'],412);
		}
		//
		$response = Gulliver::getInsuranceAvailability([
			'origin'			=> mb_convert_case($search['origin'],MB_CASE_UPPER),
			'destination'	    => mb_convert_case($search['destination'],MB_CASE_TITLE),
			'dateFrom'			=> $search['dateFrom'],
			'dateTo'			=> $search['dateTo'],
			'passengers'		=> (true==is_array($search['passengers'])) ? implode(',',$search['passengers']) : $search['passengers'],
			'currency'			=> 'ARS'
		]);
		if (false==$response) {
			return Response::json(['error'=>true,'description'=>Gulliver::$error],412);
		}
		//
		$sessionId = $response['sessionId'];
		$response = $response['availablePlans'];
		//
		foreach($response as $key => $item) {
			$response[$key]['insuranceTotalPrices']['requestedSellingPrice']['taxes'] = $item['insuranceTotalPrices']['requestedSellingPrice']['afterTax'] - $item['insuranceTotalPrices']['requestedSellingPrice']['beforeTax'];
			//
			$row = InsuranceModel::store([
				'session'        => $sessionId,
				'plan_number'    => $key,
				'item'           => json_encode($response[$key]),
				'search'         => json_encode($search)
			]);
			//  http://viajes-laravel.dev/compra/seguros/?GID=71ff1103-d3c6-4e12-92b1-0caccc864d2a&BID=1
			$response[$key]['booking'] = url().'/compra/seguros?'.http_build_query([
				'GID' => $sessionId,
				'BID' => $row->id
			]);
		}
		//
		Cookie::queue(self::$config['cookieName'],$search,self::$config['cookieTtl']);
		//
		return Response::json([
			'error'			=> false,
			'description'	=> 'Ok',
			'total'			=> sizeof($response),
			'grid'			=> view('Insurance/grid')->with([
				'destination'	=> mb_convert_case($search['destination'],MB_CASE_LOWER),
				'response'		=> $response
			])->render()
		],200);
	}
/***********************************************************************************************************************
* FUNCTIONS
***********************************************************************************************************************/
	/**
	 * Read and validate variables from the url
	 * used by results()
	 * @return array
	**/
	static function validateParams()
	{
		//
		$errors = [];
		$date_min = str_replace('+', 'P', strtoupper(self::$config['mindate']));
		$date_max = str_replace('+', 'P', strtoupper(self::$config['maxdate']));
		//
		Request::setMethod('GET');
		//
		$origin = Request::get('origen',"");
		if (""==$origin) {
			$errors[] = 'Debe elegir una ciudad de origen';
		}
		//
		$destination = Request::get('destino',"");
		if (""==$destination) {
			$errors[] = 'Debe elegir una ciudad de destino';
		}
		//
		$dateFrom = Request::get('fecha-desde',"");
		if ("" == $dateFrom) {
			$errors[] = 'Debe elegir una fecha inicial para siu seguro';
		} else {
			$validDate = dateValidate($dateFrom, $date_min, $date_max);
			if (true !== $validDate) {
				if ('min' == $validDate) {
					$errors[] = 'La fecha inicial no debe ser anterior a la fecha actual + 3 días';
				} else if ('max' == $validDate) {
					$errors[] = 'La fecha inicial no debe ser mayor que 61 meses';
				} else {
					$errors[] = 'Debe elegir una fecha válida de inicio para su seguro';
				}
			}
		}
		//
		$dateTo	= Request::get('fecha-hasta',"");
		if ("" == $dateFrom) {
			$errors[] = 'Debe elegir una fecha inicial para siu seguro';
		} else {
			$validDate = dateValidate($dateTo,$date_min,$date_max);
			if (true !== $validDate) {
				if ('min' == $validDate) {
					$errors[] = 'La fecha final no debe ser anterior a la fecha actual + 3 días';
				} else if ('max' == $validDate) {
					$errors[] = 'La fecha final no debe ser mayor que 12 meses';
				} else {
					$errors[] = 'Debe elegir una fecha válida de finalización del su seguro';
				}
			}
		}
		//
		$passengers = self::passengersParseUrl();
		if ([] == $passengers) {
			$errors[] = 'Debe especificar los pasajeros y sus edades';
		}
		//
		return [
			'errors' => $errors,
			'search' => [
				'origin'			=> $origin,
				'destination'	    => $destination,
				'dateFrom'			=> $dateFrom,
				'dateTo'			=> $dateTo,
				'passengers'		=> $passengers
			]
		];
	}

	/**
	 * Read and prepare passengers from form
	 * used in search()
	 * @return bool|string
	**/
	static function passengersParseForm()
	{
		$passengers	= Request::get('passengers',0);
		$ages		= Request::get('ages',[]);
		$return     = [];
		if (!$passengers || !sizeof($ages)) {
			return false;
		}
		//	Create the adults and children url
		for ($pass=1; $pass<=$passengers; $pass++) {
			$return[] = $ages[$pass];
		}
		return implode('-',$return);
	}

	/**
	 * Read and prepare passengers from url
	 * used in search()
	 * @return bool|string
	**/
	static function passengersParseUrl()
	{
		$passengers = Request::get('pasajeros',0);
		$passengers	= explode('-',$passengers);
		$return     = [];
		if (!sizeof($passengers)) {
			return false;
		}
		//	Create the adults and children url
		foreach($passengers as $key => $age) {
			$return[] = $age;
		}
		return $return;
	}
}