<?php

namespace App\Http\Controllers\Database;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\City_booking;
use App\Http\Models\Country;
use App\Http\Controllers\Gulliver;

class CityBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return view('cities-booking/index')->with('cities', City_booking::all());
    }

    public function fetch()
    {
		$cities = Gulliver::getCitiesBooking();
		if(true == Gulliver::$error){
			$status = 'danger';
		}else{
			foreach ($cities as $item) {
				$city = City_booking::where('id', $item['id'])->first();
				if (null == $city) {
					$city = new City_booking;
				}
				$city->forceFill($item);
				$city->save();
			}
			$status = 'success';
		}
		//
		return view('cities-booking/fetch')->with([
			'status' => $status,
			'cities' => $cities
		]);
	}

	public function query($query)
	{
		$query = strtolower(filter_var($query, FILTER_SANITIZE_STRING));
		$cities_raw = Gulliver::getCitiesBooking();
		$cities = array();

		if(!Gulliver::$error){
			foreach($cities_raw as $city){
				$city_name = strtolower($city['name']);
				if(strstr($city_name, $query)){
					$country = Country::where('code', $city['country'])->first();
					$city = array('value' => $city['name'].', '.$country->name.' ('.$city['country'].')');
					$cities[] = $city;
				}
			}
		}

		return json_encode($cities);
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
