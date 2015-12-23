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
	//	$response = Gulliver::getStates();
	//	$response = Gulliver::getStates('AR');
	//	$response = Gulliver::getStates('','B');

	//	$response = Gulliver::getCities();
	//	$response = Gulliver::getCities('AR');
	//	$response = Gulliver::getCities('AR','B');
	//	$response = Gulliver::getCities('','',1333);

	//	$response = Gulliver::getFlightsOffers();
	//	$response = Gulliver::getFlightsCalendars();
	//	$response = Gulliver::getFlightsCalendars('2287');

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
