<?php

namespace App\Http\Controllers\Home;
use App\Http\Controllers\Commons;
use App\Http\Controllers\Offers\Offers;
use App\Http\Controllers\Banks\Banks;

use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;

class Main extends Controller
{
	function __construct()
	{
		Commons::init();	
	}

	//
	public function index()
	{
		//	way of getting post vars
		//	$get = Request::query('name','lala'); dd($get);
		return view(
			'Home/index'
		)
		->with(
			[
				'HomeSearchSliders'		=> self::getSearchSliders(),
				'SearchBoxes'			=> self::getProducts('search'),
				'BanksSliders'			=> self::getBanks('slider'),
				'DestinationsSliders'	=> self::getDestinations('slider'),
//				'DestinationsSelected'	=> $offers['selected'],
            ]
        );
    }

    //	
	static function getSearchSliders()
	{
		return offers::getSearchSliders('home');
	}

	//	
	static function getProducts($mode='navbar')
	{
		$items = [];
		foreach (Setup::$settings['products'] as $key => $item)
		{
			if (true==$item['enabled'])
			{
				//
				if ('navbar' === $mode)
				{
					$items[] = [
						'name'	=> $item['name'],
						'title'	=> $item['title'],
						'href'	=> $item['href'],
					];
				} else {
					$items[$key] = [
						'name'	=> $item['name'],
						'title'	=> $item['title'],
						'href'	=> $item['href'],
						'html'	=> $item['html']
					];
					//	
					if (false == empty($item['css']))
					{
						foreach ($item['css'] as $css)
						{
						//	View::addCss($css);
						}
					}
					if (false == empty($item['js']))
					{
						foreach ($item['js'] as $js)
						{
						//	View::addJsFooter($js);
						}
					}
				}
			}
		}
		return $items;
	}

	//	
	static function getBanks($mode='slider')
	{
		return Banks::getBanks('slider');
	}

	//	
	static function getDestinations($mode='slider')
	{
		return Offers::getDestinations();
	}

	//
    static function OffersLandingPage($action="")
    {
        $offers = Offers::getDestinations();

        $selected = [];
        if ("" !== $action)
        {
            foreach ($offers as $key => $offer)
            {
                if ($action == $offer['class'])
                {
                    $selected = $offer;
                    unset($offers[$key]);
                    $offers = array_values($offers);
                }
            }
        }
        return [
            'offers'	=> $offers,
            'selected'	=> $selected
        ];
    }
}
