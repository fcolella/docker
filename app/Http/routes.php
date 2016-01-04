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
    Route::get('/', 'Cms\Main@index');
    Route::get('/home', 'Cms\Main@home');
    Route::get('/flights', 'Cms\Main@flights');
    Route::get('/regions', 'Database\RegionController@index');
	Route::group(['prefix' => 'city'], function()
	{
		Route::get('/', 'Database\CityController@index');
		Route::get('/fetch', 'Database\CityController@fetch');
	});
});

Route::get('/',['as' => 'home', 'uses' => 'Home\Main@index']);

/** **/
Route::group(['prefix' => 'seguros'], function() {
    Route::get('/', 'Insurance\InsuranceController@index');
    Route::post('search', 'Insurance\InsuranceController@search');
    Route::get('listado-{slug?}', 'Insurance\InsuranceController@results');
    Route::get('grilla', 'Insurance\InsuranceController@grid');
});


Route::get('/{landing?}/{name?}', 'Landing\LandingController@index')->where(['landing'=>'[A-Za-z]+', 'name'=>'[A-Za-z]+']);



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
