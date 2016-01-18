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

	Route::group(['prefix' => 'products'], function()
	{
		Route::get('/', ['as' => 'products.index', 'uses' => 'Database\ProductController@index']);
		Route::get('/create', ['as' => 'products.create', 'uses' => 'Database\ProductController@create']);
		Route::post('/store', ['as' => 'products.store', 'uses' => 'Database\ProductController@store']);
		Route::get('/{id_product}/edit', ['as' => 'products.edit', 'uses' => 'Database\ProductController@edit']);
		Route::post('/{id_product}/update', ['as' => 'products.update', 'uses' => 'Database\ProductController@update']);
		Route::get('/{id_product}/destroy', ['as' => 'products.delete', 'uses' => 'Database\ProductController@destroy']);
	});

	Route::group(['prefix' => 'regions'], function()
	{
		Route::get('/', ['as' => 'regions.index', 'uses' => 'Database\RegionController@index']);
		Route::get('/create', ['as' => 'regions.create', 'uses' => 'Database\RegionController@create']);
		Route::post('/store', ['as' => 'regions.store', 'uses' => 'Database\RegionController@store']);
		Route::get('/{id_region}/edit', ['as' => 'regions.edit', 'uses' => 'Database\RegionController@edit']);
		Route::post('/{id_region}/update', ['as' => 'regions.update', 'uses' => 'Database\RegionController@update']);
		Route::get('/{id_region}/destroy', ['as' => 'regions.delete', 'uses' => 'Database\RegionController@destroy']);
	});

	Route::group(['prefix' => 'cities'], function()
	{
		Route::get('/', ['as' => 'cities.index', 'uses' => 'Database\CityController@index']);
		Route::get('/query/{query}', ['as' => 'cities.query', 'uses' => 'Database\CityController@query']);
	});

	Route::group(['prefix' => 'offers_air'], function()
	{
		Route::get('/', ['as' => 'offers_air.index', 'uses' => 'Database\Offers_airController@index']);
	});

	Route::group(['prefix' => 'tags'], function()
	{
		Route::get('/', ['as' => 'tags.index', 'uses' => 'Database\TagController@index']);
		Route::get('/create', ['as' => 'tags.create', 'uses' => 'Database\TagController@create']);
		Route::post('/store', ['as' => 'tags.store', 'uses' => 'Database\TagController@store']);
		Route::get('/{id_tag}/edit', ['as' => 'tags.edit', 'uses' => 'Database\TagController@edit']);
		Route::post('/{id_tag}/update', ['as' => 'tags.update', 'uses' => 'Database\TagController@update']);
		Route::get('/{id_tag}/destroy', ['as' => 'tags.delete', 'uses' => 'Database\TagController@destroy']);
	});
});

/**  BOOKING  **/
Route::group(['prefix' => 'compra'], function()
{
	//  Ajax
	Route::get('CitiesAutocomplete', 'Booking\BookingController@CitiesAutocomplete');
	//  Calculate Installments
	Route::get('calculations', 'Booking\BookingController@Calculations');
	//  http://viajes-laravel.dev/compra/seguros?GID=230b653f-a05a-4278-9148-ea9f30f437df&BID=34
	Route::get('seguros', 'Booking\InsuranceController@Index');
	//  form submit
	Route::post('seguros', 'Booking\InsuranceController@Submit');
});

/**  WEB HOME  **/
Route::get('/',['as' => 'home', 'uses' => 'Home\Main@index']);

/**  WEB INSURANCE  **/
Route::group(['prefix' => 'seguros'], function()
{
	//  Index
    Route::get('/', 'Insurance\InsuranceController@index');
	//  landing zones
    Route::get('zonas', 'Insurance\InsuranceController@zones');
	//  Search Form submit
    Route::post('search', 'Insurance\InsuranceController@search');
	//  Results
    Route::get('listado-{slug?}', 'Insurance\InsuranceController@results');
	//  Grid
    Route::post('grilla', 'Insurance\InsuranceController@grid');
});

/** WEB LANDINGS **/
//Route::get('/{landing?}/{name?}', 'Landing\LandingController@index')->where(['landing'=>'[A-Za-z]+', 'name'=>'[A-Za-z]+']);
