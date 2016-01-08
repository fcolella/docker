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

Route::get('/','Home\Main@index');

Route::group(['prefix' => 'cities'], function()
{
	Route::get('/', ['as' => 'cities-booking.index', 'uses' => 'Database\CityBookingController@index']);
	Route::get('/fetch', ['as' => 'cities-booking.fetch', 'uses' => 'Database\CityBookingController@fetch']);
	Route::get('/query/{query}', ['as' => 'cities-booking.query', 'uses' => 'Database\CityBookingController@query']);
});

Route::get('/{landing?}/{name?}', 'Landing\Landing@index')->where(['landing'=>'[A-Za-z]+', 'name'=>'[A-Za-z]+']);



/**
//  https://ajgallego.gitbooks.io/laravel-5/content/capitulo_2_rutas_avanzadas.html
Route::group(['prefix' => 'api/offers'], function()
{
    //
    Route::get('hotels/{format?}', function($format='json') {
        //
        $name = Request::query('name','lalala');
        $response = ['name' => $name,'location' => __FILE__.':'.__LINE__, 'api' => 'offers', 'product' => 'hotels', 'format' => $format, 'status' => true, 'offers' => [ [],[],[],[],[],[] ] ];
        if ('json'===$format) {
            return Response::json($response);
        } else {
            print_r($response);die;
        }
    });
    //
    Route::get('flight/{format?}', function($format='json') {
        $name = Request::query('name','lalala');
        $response = ['name' => $name,'location' => __FILE__.':'.__LINE__, 'api' => 'offers', 'product' => 'flight', 'format' => $format, 'status' => true, 'offers' => [ [],[],[],[],[],[] ] ];
        if ('json'===$format) {
            return Response::json($response);
        } else {
            print_r($response);die;
        }
    });
});
**/
