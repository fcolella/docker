<?php

namespace App\Http\Controllers\Database;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\City;
use App\Http\Models\Country;

class CityController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return 	view('cms/cities/index')
				->with('cities', City::all());
	}

	public function query($query)
	{
		$query = strtolower(filter_var($query, FILTER_SANITIZE_STRING));
		$cities_raw = City::all();
		$cities = array();

		if(!empty($cities_raw)){
			foreach($cities_raw as $city){
				$city_name = strtolower($city->name);
				if(strstr($city_name, $query)){
					$city = array('value' => $city->name.', '.$city->country->name.' ('.$city->country->code.')');
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
