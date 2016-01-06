<?php

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
	protected static $enabled = true;
	private static $config = [
		'cookieName'		=> 'IS',
		'cookieTtl'			=> 54000,	//	15 Days
		'mindate'			=> '+3d',	//	days
		'maxdate'			=> '+12m', 	//	months
		'maxPassengers'     => 9,
		'maxAge'			=> 86,
		'pagination'		=> 10
	];

	function __construct()
	{
	//	$form = Request::all(); print_pre($form,0,0);
		if (false == self::$enabled) {
			return redirect(URL::to('/'),302)->send();
		}
		parent::__construct();
		//
		if (false==Request::ajax()) {
			Controller::addCss('Insurance/stylesheet.css');
			Controller::addJsFooter('lib/jquery.validate.js');
			Controller::addJsFooter('Insurance/SearchBox.js');
		}
		//
		view()->share([
			'InsuranceSearch'	    => Cookie::get(self::$config['cookieName']),
			'InsuranceZones'	    => Gulliver::getInsurancesFilters()['availableGeoZones'],

			'HomeSearchSliders'		=> Controller::getSearchSliders('insurance'),
			'BanksSliders'			=> Controller::getBanks('slider'),
			'DestinationsSliders'	=> Controller::getDestinations('slider'),
			'InsuranceConfig'	    => self::$config
		]);
	}

	//
	public function index()
	{
		return view(
			'Insurance/index'
		);
	}

	//
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

	//
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

	//
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
		$response = Gulliver::getInsuranceavAilability([
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
		/**
			//  http://viajes-laravel.dev/seguros/compra/?GID=71ff1103-d3c6-4e12-92b1-0caccc864d2a&RID=1
			$response[$key]['booking'] = url().'/seguros/compra/?'.http_build_query([
				'GID' => $sessionId,
				'RID' => $row->id
			]);
		**/
			//  http://viajes-laravel.dev/compra/seguros/?GID=71ff1103-d3c6-4e12-92b1-0caccc864d2a&RID=1
			$response[$key]['booking'] = url().'/compra/seguros/?'.http_build_query([
				'GID' => $sessionId,
				'RID' => $row->id
			]);
		}
		//
		Cookie::queue(self::$config['cookieName'],$search,self::$config['cookieTtl']);
		//
		return Response::json([
			'error'			=> false,
			'description'	=> 'Ok',
			'total'			=> sizeof($response),
			'grid'			=> view('Insurance/Grid')->with([
				'destination'	=> mb_convert_case($search['destination'],MB_CASE_LOWER),
				'response'		=> $response
			])->render()
		],200);
	}

	//
	function booking()
	{
		$gulliver_sessionId = Request::get('GID',"");
		$database_id        = Request::get('RID',"");
		if (""==$gulliver_sessionId) {
			abort(404);
		}
		if (""==$database_id) {
			abort(404);
		}
		//
		$row = InsuranceModel::where('session', $gulliver_sessionId)->where('id', $database_id)->first()->toArray();
		$row['search']  = json_decode($row['search'],true);
		$row['item']    = json_decode($row['item'],true);
print_pre($row,0,0);
	}
/***********************************************************************************************************************
* FUNCTIONS
***********************************************************************************************************************/
	//
	static function validateParams()
	{
		$errors = [];
		$date_min = str_replace('+', 'P', strtoupper(self::$config['mindate']));
		$date_max = str_replace('+', 'P', strtoupper(self::$config['maxdate']));

		Request::setMethod('GET');

		$origin = Request::get('origen',"");
		if (""==$origin) {
			$errors[] = 'Debe elegir una ciudad de origen';
		}

		$destination = Request::get('destino',"");
		if (""==$destination) {
			$errors[] = 'Debe elegir una ciudad de destino';
		}

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

		$passengers = self::passengersParseUrl();
		if ([] == $passengers) {
			$errors[] = 'Debe especificar los pasajeros y sus edades';
		}

		//
		$search = [
			'origin'			=> $origin,
			'destination'	    => $destination,
			'dateFrom'			=> $dateFrom,
			'dateTo'			=> $dateTo,
			'passengers'		=> $passengers
		];
		//
		return ['search'=>$search,'errors'=>$errors];
	}

	//
	static function passengersParseForm()
	{
		$passengers		    = Request::get('passengers',0);
		$ages			    = Request::get('ages',[]);
		$return     	    = [];
		if (!$passengers || !sizeof($ages)) {
			return false;
		}
		//	Create the adults and children url
		for ($pass=1; $pass<=$passengers; $pass++) {
			$return[] = $ages[$pass];
		}
		return implode('-',$return);
	}

	//
	static function passengersParseUrl()
	{
		$passengers		    = Request::get('pasajeros',0);
		$passengers		    = explode('-',$passengers);
		$return     	    = [];
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