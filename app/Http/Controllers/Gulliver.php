<?php
/**
 * http://10.0.1.38:9000/doc
 * Created by PhpStorm.
 * User: gabrielvazquez
 * Date: 23/12/15
 * Time: 9:04
 */
namespace App\Http\Controllers;
use Ixudra\Curl\Facades\Curl;
use Cache;

class Gulliver extends Controller
{
	public		static $error = false;
	private		static $cache_ttl = 0;
	private		static $cache_name = "";

	protected	static $timeout = 60;
	protected	static $returntransfer = true;
	protected	static $encoding = 'gzip';

	static function init()
	{
	//	Cache::flush();
	}

	/**
	 *
	 */
	static function reset()
	{
		//	public
		self::$error = false;
		//	private
		self::$cache_ttl = 0;
		self::$cache_name = "";
		//	protected
		self::$cache_ttl = 0;
		self::$timeout = 60;
		self::$returntransfer = true;
		self::$encoding = 'gzip';
	}

	/**
	 *
	 * @param string $service
	 * @param string $method
	 * @param array $data
	 * @return array|bool
	 */
	static function call($service="",$method="", $parameters=[])
	{
		//	Check if cache exist
		$response = Cache::get(self::$cache_name);
		if (null == $response)
		{
			//	Curl call
			$response = Curl::to( config('services.gulliver.host').':'.config('services.gulliver.port').'/'.$service.((false==empty($method)) ? '/'.$method : "") )
				->withData($parameters)
				->withOption('TIMEOUT', self::$timeout)
				->withOption('FAILONERROR', false)
				->withOption('RETURNTRANSFER', self::$returntransfer)
				->withOption('ENCODING', self::$encoding)
				->get();
#dd(['to'=>config('services.gulliver.host').':'.config('services.gulliver.port').'/'.$service.((false==empty($method)) ? '/'.$method : ""),'response'=>$response]);
			//	Check response
			if (false == $response)
			{
				self::$error = true;
				return false;
			}
#print_pre($response);
			//	Decode the response
			$response = json_decode($response, true);
#dd(['response'=>$response,'method'=>$method]);
			//	Check for json error
			if (json_last_error() != JSON_ERROR_NONE)
			{
				self::$error = 'json error: '.json_last_error();
				return false;
			}
			//	Check error
			if (false == empty($response['errors']))
			{
				self::$error = (false == empty($response['errors'][0]['description'])) ? $response['errors'][0]['description'] : true;
				return false;
			}
			//	Check data
			if (true == empty($response['data']))
			{
				self::$error = 'Empty data node in response';
				return false;
			}
			//	Check method
			if (false == empty($method) && true == empty($response['data'][$method]))
			{
				self::$error = 'Empty method node in response';
				return false;
			}
			//	return array
			if (false == empty($method))
			{
				$response = (array) $response['data'][$method];
			} else {
				$response = (array) $response['data'];
			}
			//	Cache Store ?
			if (0 < self::$cache_ttl)
			{
				$name = Cache::put(self::$cache_name, $response, self::$cache_ttl);
			}
		}
		//
		self::reset();
		//	return
		return $response;
	}

	/**
	 *
	 * @param string $countryCode
	 * @param string $stateCode
	 * @param string $cityCode
	 * @return mixed
	 */
	static function getCities($countryCode="",$stateCode="",$cityCode="")
	{
		$parameters = [];
		//	Data set ?
		("" != $countryCode)		? $parameters['countryCode'] = $countryCode : null;
		("" != $stateCode)			? $parameters['stateCode'] = $stateCode : null;
		("" != $cityCode)			? $parameters['cityCode'] = $cityCode : null;
		//
		self::$cache_name = 'gulliver-cities'.((0 < sizeof($parameters)) ? '-'.implode('-',$parameters) : "");
		self::$cache_ttl = 60;
		return self::call('services/v3.8/address','cities',$parameters);
	}

	/**
	 *
	 * @param string $countryCode
	 * @param string $stateCode
	 * @return mixed
	 */
	static function getStates($countryCode="",$stateCode="")
	{
		$parameters = [];
		//	Data set ?
		("" != $countryCode)		? $parameters['countryCode'] = $countryCode : null;
		("" != $stateCode)			? $parameters['stateCode'] = $stateCode : null;
		//
		self::$cache_name = 'gulliver-states'.((0 < sizeof($parameters)) ? '-'-implode('-',$parameters): "");
		self::$cache_ttl = 60;
		return self::call('services/v3.8/address','states',$parameters);
	}

	/*
	 *	http://200.85.108.10:9000/services/latest/flights/offers
	 * 	http://200.85.108.10:9000/services/latest/flights/offers?validDate=2016-02-02
	 *	http://200.85.108.10:9000/services/latest/flights/offers?validDate=2016-02-02&origin=BUE&destination=PSS&departureFrom=2015-01-02&departureTo=2015-01-30&paxQuantity=3&limitPriceCurrency=ARS&limitPriceAmount=340.00&requestedCurrency=EUR
	 *
	 * @param string $validDate
	 * @param string $origin
	 * @param string $destination
	 * @param string $departureFrom
	 * @param string $departureTo
	 * @param string $paxQuantity
	 * @param string $limitPriceCurrency
	 * @param string $limitPriceAmount
	 * @param string $requestedCurrency
	 * @return mixed
	 */
	static function getFlightsOffers($validDate="",$origin="",$destination="",$departureFrom="",$departureTo="",$paxQuantity="",$limitPriceCurrency="",$limitPriceAmount="",$requestedCurrency="")
	{
		$parameters = [];
		//	Data set ?
		("" != $validDate)			? $parameters['validDate'] = $validDate : null;
		("" != $origin)				? $parameters['origin'] = $origin : null;
		("" != $destination)		? $parameters['destination'] = $destination : null;
		("" != $departureFrom)		? $parameters['departureFrom'] = $departureFrom : null;
		("" != $departureTo)		? $parameters['departureTo'] = $departureTo : null;
		("" != $paxQuantity)		? $parameters['paxQuantity'] = $paxQuantity : null;
		("" != $limitPriceCurrency)	? $parameters['limitPriceCurrency'] = $limitPriceCurrency : null;
		("" != $limitPriceAmount)	? $parameters['limitPriceAmount'] = $limitPriceAmount : null;
		("" != $requestedCurrency)	? $parameters['requestedCurrency'] = $requestedCurrency : null;
		//
		self::$cache_name = 'gulliver-flights-offers'.((0 < sizeof($parameters)) ? '-'.implode('-',$parameters): "");
		self::$cache_ttl = 60;
		return self::call('services/latest/flights','offers',$parameters);
	}

	/**
	 *
	 * 	http://200.85.108.10:9000/services/latest/flights/offers/calendars
	 * 	http://200.85.108.10:9000/services/latest/flights/offers/calendars?offerId=1
	 *
	 * @param string $offerId
	 * @return mixed
	 */
	static function getFlightsCalendars($offerId="")
	{
		$parameters = [];
		//	Data set ?
		("" != $offerId)			? $parameters['offerId'] = $offerId : null;
		//
		self::$cache_name = 'gulliver-flights-calendars'.((0 < sizeof($parameters)) ? '-'.implode('-',$parameters) : "");
		self::$cache_ttl = 60;
		return self::call('services/latest/flights/offers','calendars',$parameters);
	}

	/**
	 *
	 * @return array|bool
	 */
	static function getInsurancesFilters()
	{
		//
		self::$cache_name = 'gulliver-insurances-filters';
		self::$cache_ttl = (60*24);
		return self::call('services/latest/availability/insurances/filters','',[]);
	}

	/**
	 * http://200.85.108.10:9000/services/latest/availability/insurances?origin=bue&destination=EUROPA¤cy=ARS&passengers=30&dateFrom=2014-02-02&dateTo=2014-02-10
	 */
	static function getInsuranceavAilability($parameters=[])
	{
		//
		self::$cache_name = 'gulliver-insurances-availability-'.implode('-',$parameters);
		self::$cache_ttl = 60;
		return self::call('services/latest/availability/insurances','',$parameters);
	}
}
