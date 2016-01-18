<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\Config;
use App\Http\Controllers\Offers\Offers;
use App\Http\Controllers\Banks\Banks;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	static $settings = [];
	static $route = "";
	static $refresh = "";
	static $static = "";
	static $jsHeader = [];
	static $jsFooter = [];
	static $css = [];

	function __construct()
	{
		//
		self::$settings = Config::get('garbarinoviajes');
		//
		self::$static = url('statics') . '/';
		//
		if (false==\Illuminate\Support\Facades\Request::ajax()) {
			self::addJsHeader('http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js');

			self::addCss('main.css');   // ex bootstrap
			self::addCss('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
			self::addCss('https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/redmond/jquery-ui.css');
			self::addCss('details.css');
		//	self::addCss('1200.css');

			self::addJsFooter('https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js');
			self::addJsFooter('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
		}
		//
		\Illuminate\Support\Facades\Blade::extend(function($value)
		{
			return preg_replace('/(\s*)@(break|continue)(\s*)/', '$1<?php $2; ?>$3', $value);
		});
		//
		view()->composer('*', 'App\Http\Composers\ViewComposer');
	}

	/**
	 * Agrega js's al header del html
	 **/
	static function addJsHeader($src)
	{
		if ($src == "") {
			return;
		}
		self::$jsHeader[] = self::MakeJS($src);
	}

	/**
	 * Agrega js's al footer del html
	 **/
	static function addJsFooter($src = "")
	{
		if ($src == "") {
			return;
		}
		self::$jsFooter[] = self::MakeJS($src);
	}

	/**
	 * Agrega css al header del html
	 **/
	static function addCss($href = "")
	{
		if ($href == "") {
			return;
		}
		self::$css[] = self::MakeCSS($href);
	}

	/**
	 *
	 * @param string $href
	 * @return void|string
	 **/
	static function MakeCSS($href)
	{
		//	If its an external file
		if (strpos($href, 'http') !== false) {
			return '<link href="' . $href . '" rel="stylesheet" type="text/css">';
		}
		return '<link href="' . self::$static . 'css/' . $href . (("" != self::$refresh) ? '?upd=' . self::$refresh : "") . '" rel="stylesheet" type="text/css">';
	}

	/**
	 *
	 * @param string $src
	 * @return void|string
	 **/
	static function MakeJS($src)
	{
		//	If its an external file
		if (strpos($src, 'http') !== false) {
			return '<script src="' . $src . '" type="text/javascript"></script>';
		}
		return '<script src="' . self::$static . '/js/' . $src . (("" != self::$refresh) ? '?upd=' . self::$refresh : "") . '" type="text/javascript"></script>';
	}

	//
	static function getHeaders()
	{
		$items = [];
		if (false == empty(self::$settings['header'])) {
			foreach (self::$settings['header'] as $key => $item) {
				if (true == $item['enabled']) {
					$items[] = $item;
				}
			}
		}
		return $items;
	}

	//
	static function getProducts($mode = 'navbar')
	{
		$items = [];
		if (false == empty(self::$settings['products'])) {
			foreach (self::$settings['products'] as $key => $item) {
				if (true == $item['enabled']) {
					//
					if ('navbar' === $mode) {
						$items[] = [
							'name' => $item['name'],
							'title' => $item['title'],
							'href' => $item['href'],
						];
					} else {
						$items[$key] = [
							'name' => $item['name'],
							'title' => $item['title'],
							'href' => $item['href'],
							'html' => $item['html']
						];
						if (false == empty($item['css'])) {
							foreach ($item['css'] as $css) {
								//    View::addCss($css);
							}
						}
						if (false == empty($item['js'])) {
							foreach ($item['js'] as $js) {
								//   View::addJsFooter($js);
							}
						}
					}
				}
			}
		}
		return $items;
	}

	//
	static function getNavbarExtra()
	{
		$items = [];
		if (false == empty(self::$settings['navbar'])) {
			foreach (self::$settings['navbar'] as $key => $item) {
				if (true == $item['enabled']) {
					$items[] = $item;
				}
			}
		}
		return $items;
	}

	//
	static function getFooterLinks()
	{
		$items = [];
		if (false == empty(self::$settings['footer'])) {
			foreach (self::$settings['footer'] as $key => $footer) {
				if (true === $footer) {
					$items[$key] = true;
					continue;
				}
				foreach ($footer as $item) {
					if (true == $item['enabled']) {
						$items[$key][] = $item;
					}
				}
			}
		}
		return $items;
	}

	//
	static function getSearchSliders($mode='home')
	{
		return offers::getSearchSliders($mode);
	}

	//
	static function getBanks($mode='slider')
	{
		return Banks::getBanks('slider');
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

	//
	static function getDestinations($mode='slider')
	{
		return Offers::getDestinations();
	}
}
