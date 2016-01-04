<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Commons;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;

class LandingController extends Controller
{
    protected static $enabled = false;

    function __construct()
    {
        if (false == self::$enabled) {
            return redirect(URL::to('/'),302)->send();
        }
        Commons::init();
    }

    //
    public function index($landing="",$name="")
    {
        dd(['$landing'=>$landing,'$name'=>$name,'source',__FILE__.':'.__LINE__]);
    }
}
