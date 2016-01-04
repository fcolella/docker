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

Route::get('/','Home\Main@index');

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
