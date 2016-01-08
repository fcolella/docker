<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Models\City;

class Offer_air extends Model
{
	protected $table = 'offers_air';
	public $timestamps = false;

	/**
	 * Get the countries for this Air Offer.
	 */
	public function countries()
	{
		return $this->hasMany('App\Http\Models\Country', 'id_region');
	}

	/**
	 * Get the city associated with this Air Offer.
	 */
	public function city($city_code)
	{
		return City::where('code', $city_code)->get();
	}

	/**
	 * Get the currency from the requested selling price.
	 */
	public function currency()
	{
		$currency = explode(" ", $this->sellingPriceRequestedAfterTax);
		return $currency[0];
	}

	/**
	 * Get the price from the requested selling price.
	 */
	public function price()
	{
		$price = explode(" ", $this->sellingPriceRequestedAfterTax);
		return $price[1];
	}

	/**
	 * Get the fly type from ranges.
	 */
	public function flyType()
	{
		$departure = false;
		$arrival = false;
		$fly_type = "";

		if(!empty($this->departureFrom)) $departure = true;
		if(!empty($this->arrivalFrom)) $arrival = true;

		if($departure && $arrival){
			$fly_type = "Ida y Vuelta";
		}else if($departure){
			$fly_type = "Ida";
		}else{
			$fly_type = "Vuelta";
		}

		return $fly_type;
	}

	/**
	 * Get the Air Offer description formatted for an html select element.
	 * Example: Buenos Aires - Orlando | ARS 14076
	 */
	public function selectDescription()
	{
		$city_origin = $this->city($this->origin)[0]->name;
		$city_destination = $this->city($this->destination)[0]->name;
		$currency = $this->currency();
		$price = $this->price();

		$description = $city_origin." - ".$city_destination." | ".$currency." ".$price;

		return $description;
	}
}