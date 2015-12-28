<?php

namespace App\Http\Controllers\Database;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\City;
use App\Http\Controllers\Gulliver;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		return view('cms/cities/index')->with('cities', City::all());
    }

    public function fetch()
    {
		$cities = Gulliver::getCities();
		if (true==Gulliver::$error) {
			$status = 'danger';
		} else {
			foreach ($cities as $item) {
				$city = City::where('id', $item['id'])->first();
				if (null == $city) {
					$city = new City;
				}
				$city->forceFill($item);
				$city->save();
			}
			$status = 'success';
		}
		//
		return view('cms/cities/fetch')->with([
			'status' => $status,
			'cities' => $cities
		]);
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
