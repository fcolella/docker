<?php

namespace App\Http\Controllers\Database;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Controllers\Gulliver;
use App\Http\Models\Offer_air;

class Offers_airController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$offers_raw = Gulliver::getFlightsOffers();
		$error_gulliver = false;

		if(Gulliver::$error){
			$error_gulliver = Gulliver::$error;
		}else{
			DB::table('offers_air')->truncate();
			$error_offer = false;

			foreach($offers_raw as $item){
				$offer = new Offer_air;

				if(isset($item['offerId'])) $offer->offerId = $item['offerId'];
				if(isset($item['airline'])) $offer->airline = $item['airline'];
				if(isset($item['origin'])) $offer->origin = $item['origin'];
				if(isset($item['destination'])) $offer->destination = $item['destination'];

				if(isset($item['ranges']) && !empty($item['ranges'])){
					foreach($item['ranges'] as $range){
						if($range['rangeType'] == 'DEPARTURE'){
							if(isset($range['from'])) $offer->departureFrom = $range['from'];
							if(isset($range['to'])) $offer->departureTo = $range['to'];
						}else{
							if(isset($range['from'])) $offer->arrivalFrom = $range['from'];
							if(isset($range['to'])) $offer->arrivalTo = $range['to'];
						}
					}
				}

				if(isset($item['description'])) $offer->description = $item['description'];
				if(isset($item['minStay'])) $offer->minStay = $item['minStay'];
				if(isset($item['maxStay'])) $offer->maxStay = $item['maxStay'];
				if(isset($item['fareBasis'])) $offer->fareBasis = $item['fareBasis'];
				if(isset($item['validFrom'])) $offer->validFrom = $item['validFrom'];
				if(isset($item['validTo'])) $offer->validTo = $item['validTo'];
				if(isset($item['bookingClasses'])) $offer->bookingClasses = implode(", ", $item['bookingClasses']);
				if(isset($item['departureFlightNumber'])) $offer->departureFlightNumber = $item['departureFlightNumber'];
				if(isset($item['returnFlightNumber'])) $offer->returnFlightNumber = $item['returnFlightNumber'];
				if(isset($item['ticketingLimitDate'])) $offer->ticketingLimitDate = $item['ticketingLimitDate'];
				if(isset($item['completeTripBeforeDate'])) $offer->completeTripBeforeDate = $item['completeTripBeforeDate'];
				if(isset($item['sellingPriceAfterTax'])) $offer->sellingPriceAfterTax = implode(" ", $item['sellingPriceAfterTax']);
				if(isset($item['sellingPriceRequestedAfterTax'])) $offer->sellingPriceRequestedAfterTax = implode(" ", $item['sellingPriceRequestedAfterTax']);
				if(isset($item['sellingCondition'])) $offer->sellingCondition = $item['sellingCondition'];
				if(isset($item['minSeatsAtDeparture'])) $offer->minSeatsAtDeparture = $item['minSeatsAtDeparture'];
				if(isset($item['minSeatsAtArrival'])) $offer->minSeatsAtArrival = $item['minSeatsAtArrival'];
				if(isset($item['availableSeats'])) $offer->availableSeats = $item['availableSeats'];

				if(!$offer->save()) $error_offer = true;
			}

			if($error_offer) $error_gulliver = "One or more Air Offers could not be saved.";
		}

		return 	view('cms/offers_air/all')
				->with('error', $error_gulliver)
				->with('offers_air', Offer_air::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
