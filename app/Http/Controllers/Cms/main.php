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

class Main extends Controller
{
    function index($params=[])
    {
        //way of getting post vars
//        $get = Request::query('name','lala'); dd($get);
        return view('cms/index');
        //$params = Route::current()->parameters();
        dd($params);
    }
    function home($params=[])
    {
        //$params = Route::current()->parameters();
        dd($params);
    }
    function flights($params=[])
    {
        //$params = Route::current()->parameters();
        dd($params);
    }
}