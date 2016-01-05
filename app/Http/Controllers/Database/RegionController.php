<?php

namespace App\Http\Controllers\Database;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Region;
use App\Http\Models\Country;

class RegionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

		return 	view('cms/regions/all')
				->with('regions', Region::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return 	view('cms/regions/create')
				->with('countries', Country::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate($request, [
			'name' => 'required',
			'countries' => 'required',
		]);

		$region = new Region;
		$region->name       = $request->get('name');
		$region->save();

		$country_codes 		= $request->get('countries');
		foreach($country_codes as $country_code){
			$country = Country::findOrFail($country_code);
			$country->id_region = $region->id;
			$country->save();
		}

		return 	redirect()->route('regions.index')
				->with('message_success', 'Region '.$region->name.' has been successfully created');
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
     * @param  int  $id_region
     * @return \Illuminate\Http\Response
     */
    public function edit($id_region)
    {
		$region = Region::findOrFail($id_region);
		$region_countries = $region->countries()->getResults()->keyBy('code')->toArray();

		$all_countries = Country::orderBy('name', 'asc')->get();
		$all_countries_ordered_list = collect();
		$filtered_country_list = collect();

		foreach($all_countries as $country){
			if(array_key_exists($country->code, $region_countries)){
				$filtered_country_list->push($country->code);
			}
		}

		$current_country_letter = '-';
		$helper_collection = collect();
		$countries_length = $all_countries->count() - 1;
		foreach($all_countries as $key => $country){
			$country_letter = strtolower($country->name[0]);

			if($country_letter != $current_country_letter){
				if($current_country_letter != '-') $all_countries_ordered_list->put(strtoupper($current_country_letter), $helper_collection);
				$current_country_letter = $country_letter;
				$helper_collection = collect();
			}

			$helper_collection->push($country);
			if($key == $countries_length) $all_countries_ordered_list->put(strtoupper($current_country_letter), $helper_collection);
		}

		return 	view('cms/regions/edit')
				->with('region', $region)
				->with('countries', $all_countries)
				->with('countries_ordered_list', $all_countries_ordered_list)
				->with('filtered_country_list', $filtered_country_list);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_region)
    {
		$this->validate($request, [
			'name' => 'required',
			'countries' => 'required',
		]);

		$region = Region::findOrFail($id_region);
		$region->name       = $request->get('name');
		$region->save();

		//Reset
		$region_countries = Country::where('id_region', $id_region)->get();
		foreach($region_countries as $country){
			$country->id_region = null;
			$country->save();
		}

		//Set new ones
		$country_codes 		= $request->get('countries');
		foreach($country_codes as $country_code){
			$country = Country::findOrFail($country_code);
			$country->id_region = $region->id;
			$country->save();
		}

		return 	redirect()->route('regions.index')
			->with('message_update', 'Region '.$region->name.' has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_region
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_region)
    {
		$region = Region::findOrFail($id_region);
		$region_name = $region->name;
		$region->delete();

		$region_countries = Country::where('id_region', $id_region)->get();
		foreach($region_countries as $country){
			$country->id_region = null;
			$country->save();
		}

		return 	redirect()->route('regions.index')
			->with('message_delete', 'Region '.$region_name.' has been successfully deleted');
    }
}
