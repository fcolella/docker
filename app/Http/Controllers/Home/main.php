<?php

namespace App\Http\Controllers\Home;

use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;

class Main extends Controller
{
	function __construct()
	{
		parent::__construct();
	}

	//
	public function index()
	{
		return view(
			'Home/index'
		)
		->with(
			[
				'HomeSearchSliders'		=> Controller::getSearchSliders('home'),
				'SearchBoxes'			=> Controller::getProducts('search'),
				'BanksSliders'			=> Controller::getBanks('slider'),
				'DestinationsSliders'	=> Controller::getDestinations('slider'),
//				'DestinationsSelected'	=> $offers['selected'],
            ]
        );
    }
}
