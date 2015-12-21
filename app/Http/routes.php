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

Route::get('/','Home\Main@index');

Route::get('/{landing?}/{name?}', function ($landing="", $name="") {
    dd(__FILE__.':'.__LINE__);
    return Landing::index();
})->where(['landing'=>'[A-Za-z]+', 'name'=>'[A-Za-z]+']);

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
