<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/**  CMS  **/
Route::group(['prefix' => 'cms'], function()
{
    Route::get('/', ['as' => 'cms.index', 'uses' => 'Cms\Main@index']);
    Route::get('/home', ['as' => 'cms.home', 'uses' => 'Cms\Main@home']);
    Route::get('/flights', ['as' => 'cms.flights', 'uses' => 'Cms\Main@flights']);
	Route::group(['prefix' => 'regions'], function()
	{
		Route::get('/', ['as' => 'regions.index', 'uses' => 'Database\RegionController@index']);
		Route::get('/create', ['as' => 'regions.create', 'uses' => 'Database\RegionController@create']);
		Route::post('/store', ['as' => 'regions.store', 'uses' => 'Database\RegionController@store']);
		Route::get('/{id_region}/edit', ['as' => 'regions.edit', 'uses' => 'Database\RegionController@edit']);
		Route::post('/{id_region}/update', ['as' => 'regions.update', 'uses' => 'Database\RegionController@update']);
		Route::get('/{id_region}/destroy', ['as' => 'regions.delete', 'uses' => 'Database\RegionController@destroy']);
	});
	Route::group(['prefix' => 'city'], function()
	{
		Route::get('/', ['as' => 'cities.index', 'uses' => 'Database\CityController@index']);
		Route::get('/fetch', ['as' => 'cities.fetch', 'uses' => 'Database\CityController@fetch']);
	});
});


/**  BOOKING  **/
Route::group(['prefix' => 'compra'], function()
{
	//  Ajax
	Route::get('CitiesAutocomplete', 'Booking\BookingController@CitiesAutocomplete');
	Route::get('calculations', 'Booking\BookingController@Calculations');
	//  http://viajes-laravel.dev/compra/seguros?GID=230b653f-a05a-4278-9148-ea9f30f437df&RID=34
	Route::get('seguros', 'Booking\InsuranceController@Index');
	//  form submit
	Route::post('seguros', 'Booking\InsuranceController@Submit');
});


/**  WEB HOME  **/
Route::get('/',['as' => 'home', 'uses' => 'Home\Main@index']);

/**  WEB INSURANCE  **/
Route::group(['prefix' => 'seguros'], function()
{
    Route::get('/', 'Insurance\InsuranceController@index');
    Route::post('search', 'Insurance\InsuranceController@search');
    Route::get('listado-{slug?}', 'Insurance\InsuranceController@results');
    Route::post('grilla', 'Insurance\InsuranceController@grid');
//	Route::get('compra', 'Insurance\InsuranceController@booking');
});

/** WEB LANDINGS **/
//Route::get('/{landing?}/{name?}', 'Landing\LandingController@index')->where(['landing'=>'[A-Za-z]+', 'name'=>'[A-Za-z]+']);
