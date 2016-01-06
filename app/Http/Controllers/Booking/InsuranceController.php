<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Booking;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Insurance\InsuranceModel;

class InsuranceController extends BookingController
{
	function __construct()
	{
#		$form = Request::all(); print_pre($form,0,1);
		parent::__construct();
#		dd(__FILE__.':'.__LINE__);
	}

	//  http://viajes-laravel.dev/compra/seguros?GID=0aae559b-f84b-480e-8c88-4efab51b3c7e&RID=4
	function index()
	{
		$gulliver_sessionId = Request::get('GID',"");
		$database_id        = Request::get('RID',"");
		if (""==$gulliver_sessionId) {
			abort(404);
		}
		if (""==$database_id) {
			abort(404);
		}
		//
		$row = InsuranceModel::where('session', $gulliver_sessionId)->where('id', $database_id)->first()->toArray();
		$row['search']  = json_decode($row['search'],true);
		$row['item']    = json_decode($row['item'],true);
		//
		BookingController::displayCommons();
		//
		$yearTo     = explode('-', $row['search']['dateTo']);
		$topYear    = 86 - ($yearTo[0] - date('Y'));
		view()->share([
			'infoPlan'          => $row['item'],
			'search'            => $row['search'],
			'currentTodayYear'  => date('Y'),
			'topYear'           => $topYear,
		]);
	}
}