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
	public		static $cache_name = "";
	private		static $data = [];

	protected static $timeout = 60;
	protected static $returntransfer = true;
	protected static $encoding = 'gzip';

	/**
	 *
	 */
	static function reset()
	{
		self::$data = [];
	//	self::$cache_name = "";
	//	Cache::flush();
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
		//	Curl call
		$response = Curl::to(config('services.gulliver.host').':'.config('services.gulliver.port').'/'.$service.'/'.$method)
			->withData(['data'=>$data,'asJson'=>false])
			->withOption('TIMEOUT',self::$timeout)
			->withOption('FAILONERROR',false)
			->withOption('RETURNTRANSFER',self::$returntransfer)
			->withOption('ENCODING',self::$encoding)
			->get();
		//	Check response
		if (false==$response)
		{
			self::$error = true;
			return false;
		}
		//	Decode the response
		$response = json_decode($response,true);
		//	Check for json error
		if (json_last_error() != JSON_ERROR_NONE)
		{
			self::$error = 'json error: '.json_last_error();
			return false;
		}
		//	Check error
		if (false==empty($response['errors']))
		{
			self::$error = (false==empty($response['errors'][0]['description'])) ? $response['errors'][0]['description'] : true;
			return false;
		}
		//	Check data
		if (true==empty($response['data']))
		{
			self::$error = 'Empty data node in response';
			return false;
		}
		//	Check method
		if (false==empty($method) && true==empty($response['data'][$method]))
		{
			self::$error = 'Empty method node in response';
			return false;
		}
		//
		self::reset();
		//	return array
		return (array) $response['data'][$method];
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
		if ("" != $countryCode)
		{
			self::$data['countryCode'] = $countryCode;
		}
		if ("" != $stateCode)
		{
			self::$data['stateCode'] = $stateCode;
		}
		if ("" != $cityCode)
		{
			self::$data['cityCode'] = $cityCode;
		}
		//
		if (0 < sizeof(self::$data))
		{
			self::$cache_name = 'gulliver-cities-'.implode('-', self::$data);
		} else {
			self::$cache_name = 'gulliver-cities';
		}
		//
		return Cache::get(self::$cache_name, function()
		{
			$response = self::call('services/v3.8/address','cities',self::$data);
			if (false!=$response)
			{
				Cache::put(self::$cache_name, $response, 60);
			}
			return $response;
		});
	}

	/**
	 *
	 * @param string $countryCode
	 * @param string $stateCode
	 * @return mixed
	 */
	static function getStates($countryCode="",$stateCode="")
	{
		if ("" != $countryCode)
		{
			self::$data['countryCode'] = $countryCode;
		}
		if ("" != $stateCode)
		{
			self::$data['stateCode'] = $stateCode;
		}
		//
		if (0 < sizeof(self::$data))
		{
			self::$cache_name = 'gulliver-states-'.implode('-', self::$data);
		} else {
			self::$cache_name = 'gulliver-states';
		}
		//
		return Cache::get(self::$cache_name, function()
		{
			$response = self::call('services/v3.8/address','states',self::$data);
			if (false!=$response)
			{
				Cache::put(self::$cache_name, $response, 60);
			}
			return $response;
		});
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
		if ("" != $validDate)
		{
			self::$data['validDate'] = $validDate;
		}
		if ("" != $origin)
		{
			self::$data['origin'] = $origin;
		}
		if ("" != $destination)
		{
			self::$data['destination'] = $destination;
		}
		if ("" != $departureFrom)
		{
			self::$data['departureFrom'] = $departureFrom;
		}
		if ("" != $departureTo)
		{
			self::$data['departureTo'] = $departureTo;
		}
		if ("" != $paxQuantity)
		{
			self::$data['paxQuantity'] = $paxQuantity;
		}
		if ("" != $limitPriceCurrency)
		{
			self::$data['limitPriceCurrency'] = $limitPriceCurrency;
		}
		if ("" != $limitPriceAmount)
		{
			self::$data['limitPriceAmount'] = $limitPriceAmount;
		}
		if ("" != $requestedCurrency)
		{
			self::$data['requestedCurrency'] = $requestedCurrency;
		}
		//
		if (0 < sizeof(self::$data))
		{
			self::$cache_name = 'gulliver-flights-offers-'.implode('-', self::$data);
		} else {
			self::$cache_name = 'gulliver-flights-offers';
		}
		//
		return Cache::get(self::$cache_name, function()
		{
			$response = self::call('services/latest/flights','offers',self::$data);
			if (false!=$response)
			{
				Cache::put(self::$cache_name, $response, 60);
			}
			return $response;
		});
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
		if ("" != $offerId)
		{
			self::$data['offerId'] = $offerId;
		}
		//
		if (0 < sizeof(self::$data))
		{
			self::$cache_name = 'gulliver-flights-calendars-'.implode('-', self::$data);
		} else {
			self::$cache_name = 'gulliver-flights-calendars';
		}
		//
		return Cache::get(self::$cache_name, function()
		{
			$response = self::call('services/latest/flights/offers','calendars',self::$data);
			if (false!=$response)
			{
				Cache::put(self::$cache_name, $response, 60);
			}
			return $response;
		});
	}
}
