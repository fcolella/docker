<?php

namespace App\Http\Controllers\Insurance;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Commons;
use App\Http\Controllers\Gulliver;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Jaybizzle\Safeurl\Facades\Safeurl;

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
		'pagination'		=> 10,
	//	'gmap-api-key'		=> 'AIzaSyCr9TSmbziRz1sG8HCBZpGgzvYrqRPiuH4',
	];

	function __construct()
	{
	//	$form = Request::all(); Commons::print_pre($form,0,0);
		if (false == self::$enabled) {
			return redirect(URL::to('/'),302)->send();
		}
		Commons::init();
		//
		if (false==Request::ajax()) {
			//	Commons::addCss('Insurance/stylesheet.css');
			//	Commons::addJsFooter('https://maps.googleapis.com/maps/api/js?key='.self::$config['gmap-api-key']);
			Commons::addJsFooter('lib/jquery.validate.js');
			Commons::addJsFooter('Insurance/SearchBox.js');
		}

		//
		view()->share([
			'InsuranceSearch'	=> Cookie::get(self::$config['cookieName']),
			'InsuranceZones'	=> Gulliver::getInsurancesFilters()['availableGeoZones'],
			'InsuranceConfig'	=> self::$config
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

	//	$destination		= Request::get('destination',"");
		$search = [
			'origen'		=> mb_convert_case(Request::get('origin',""),MB_CASE_LOWER),
			'destino'	    => Request::get('destination',""),
			'fecha-desde'	=> Commons::dateFormat(Request::get('dateFrom',"")),
			'fecha-hasta'	=> Commons::dateFormat(Request::get('dateTo',"")),
			'pasajeros'	    => self::passengersParseForm()
		];
	//	$redirect = URL::to('/seguros/listado-de-seguros-en-'. Safeurl::make($destination)).'/?'.http_build_query($search);
		$redirect = URL::to('/seguros/listado-de-seguros/?'.http_build_query($search));
#Commons::print_pre(['search'=>$search,'redirect'=>$redirect]);
		return redirect($redirect)->send();
	}

	//
	public function results()
	{
		$parameters = self::validateParams();
#Commons::print_pre(['params'=>$params['search'],'errors'=>$params['errors']]);
		Commons::$route = 'insurance-results';
		Commons::addJsFooter('Insurance/Results.js');
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
	static function validateParams()
	{
		$errors = [];
		$date_min = str_replace('+', 'P', strtoupper(self::$config['mindate']));
		$date_max = str_replace('+', 'P', strtoupper(self::$config['maxdate']));

		Request::setMethod('GET');
		$form = Request::all(); Commons::print_pre($form,0,0);

		$origin = Request::get('origen',"");
		$origin = mb_convert_case($origin,MB_CASE_TITLE);
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
			$validDate = Commons::dateValidate($dateFrom, $date_min, $date_max);
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
			$validDate = Commons::dateValidate($dateTo,$date_min,$date_max);
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
Commons::print_pre(['search'=>$search,'errors'=>$errors],0,0);
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
#Commons::print_pre(['$passengers'=>$passengers,'$ages'=>$ages,'$return'=>$return]);
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
#Commons::print_pre(['$passengers'=>$passengers,'$return'=>$return]);
		return $return;
	}
}