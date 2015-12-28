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
	private		static $data = [];

	protected static $timeout = 60;
	protected static $returntransfer = true;
	protected static $encoding = 'gzip';

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
		self::$data = [];
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
	static function call($service="",$method="", $data=[])
	{
		Cache::flush();
		//	Check if cache exist
		$response = Cache::get(self::$cache_name);
		if (null == $response)
		{
			//	Curl call
			$response = Curl::to(config('services.gulliver.host') . ':' . config('services.gulliver.port') . '/' . $service . '/' . $method)
				->withData($data)
				->withOption('TIMEOUT', self::$timeout)
				->withOption('FAILONERROR', false)
				->withOption('RETURNTRANSFER', self::$returntransfer)
				->withOption('ENCODING', self::$encoding)
				->get();
			//	Check response
			if (false == $response)
			{
				self::$error = true;
				return false;
			}
			//	Decode the response
			$response = json_decode($response, true);
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
				Cache::put(self::$cache_name, $response, self::$cache_ttl);
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
		//	Data set ?
		("" != $countryCode)		? self::$data['countryCode'] = $countryCode : null;
		("" != $stateCode)			? self::$data['stateCode'] = $stateCode : null;
		("" != $cityCode)			? self::$data['cityCode'] = $cityCode : null;
		//
		self::$cache_name = 'gulliver-cities'.((0 < sizeof(self::$data)) ? '-'.implode('-', self::$data) : "");
		//
		self::$cache_ttl = 60;
		//
		return self::call('services/v3.8/address','cities',self::$data);
	}

	/**
	 *
	 * @param string $countryCode
	 * @param string $stateCode
	 * @return mixed
	 */
	static function getStates($countryCode="",$stateCode="")
	{
		//	Data set ?
		("" != $countryCode)		? self::$data['countryCode'] = $countryCode : null;
		("" != $stateCode)			? self::$data['stateCode'] = $stateCode : null;
		//
		self::$cache_name = 'gulliver-states'.((0 < sizeof(self::$data)) ? '-'-implode('-', self::$data): "");
		//
		self::$cache_ttl = 60;
		//
		return self::call('services/v3.8/address','states',self::$data);
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
		//	Data set ?
		("" != $validDate)			? self::$data['validDate'] = $validDate : null;
		("" != $origin)				? self::$data['origin'] = $origin : null;
		("" != $destination)		? self::$data['destination'] = $destination : null;
		("" != $departureFrom)		? self::$data['departureFrom'] = $departureFrom : null;
		("" != $departureTo)		? self::$data['departureTo'] = $departureTo : null;
		("" != $paxQuantity)		? self::$data['paxQuantity'] = $paxQuantity : null;
		("" != $limitPriceCurrency)	? self::$data['limitPriceCurrency'] = $limitPriceCurrency : null;
		("" != $limitPriceAmount)	? self::$data['limitPriceAmount'] = $limitPriceAmount : null;
		("" != $requestedCurrency)	? self::$data['requestedCurrency'] = $requestedCurrency : null;
		//
		self::$cache_name = 'gulliver-flights-offers'.((0 < sizeof(self::$data)) ? '-'.implode('-', self::$data): "");
		//
		self::$cache_ttl = 60;
		//
		return self::call('services/latest/flights','offers',self::$data);
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
		//	Data set ?
		("" != $offerId)			? self::$data['offerId'] = $offerId : null;
		//
		self::$cache_name = 'gulliver-flights-calendars'.((0 < sizeof(self::$data)) ? '-'.implode('-', self::$data) : "" );
		//
		self::$cache_ttl = 60;
		//
		return self::call('services/latest/flights/offers','calendars',self::$data);
	}
}
