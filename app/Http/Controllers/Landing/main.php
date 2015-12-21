<?php

namespace App\Http\Controllers\Landing;
use App\Http\Controllers\Commons;
use App\Http\Controllers\Offers\Offers;
use App\Http\Controllers\Banks\Banks;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Landing extends Controller
{
    function __construct()
    {
        Commons::init();
    }

    //
    public function index()
    {
dd(__FILE__.':'.__LINE__);
    }
}