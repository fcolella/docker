<?php
/**
 * Created by PhpStorm.
 * User: gabrielvazquez
 * Date: 22/12/15
 * Time: 9:04
 */
namespace App\Http\Controllers\Cms;

use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Gulliver;

class Main extends Controller
{
	function index($params=[])
	{
	//	$response = Gulliver::getStatesBooking();
	//	$response = Gulliver::getStatesBooking('AR');
	//	$response = Gulliver::getStatesBooking('','B');

	//	$response = Gulliver::getCitiesBooking();
	//	$response = Gulliver::getCitiesBooking('AR');
	//	$response = Gulliver::getCitiesBooking('AR','B');
	//	$response = Gulliver::getCitiesBooking('','',1333);

	//	$response = Gulliver::getFlightsOffers();
	//	$response = Gulliver::getFlightsCalendars();
	//	$response = Gulliver::getFlightsCalendars('2287');
	//print_r('<pre>');print_r(Gulliver::$error);print_r("\n");print_r($response); print_r('</pre><br>'); die(__FILE__.':'.__LINE__);

		//	way of getting post vars
		//	$get = Request::query('name','lala'); dd($get);
		return view('cms/index');
		//	$params = Route::current()->parameters();
		dd($params);
	}
	function home($params=[])
	{
		//	$params = Route::current()->parameters();
		dd($params);
	}
	function flights($params=[])
	{
		//	$params = Route::current()->parameters();
		dd($params);
	}
}
