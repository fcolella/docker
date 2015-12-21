<?php
/**
 * Created by PhpStorm.
 * User: gabrielvazquez
 * Date: 18/12/15
 * Time: 14:41
**/

namespace App\Http\Controllers;

use App\Http\Controllers\Home\Setup;

class Commons
{
	static $refresh = "";
	static $static = "";
	static $jsHeader = [];
	static $jsFooter = [];
	static $css = [];

	//	
	static function getJsHeader()
	{
		return self::$jsHeader;
	}
	
	/**
	 * Agrega js's al header del html
	**/
	static function addJsHeader($src)
	{
		if ($src == "")
		{
			return;
		}
		self::$jsHeader[] = self::MakeJS($src);
	}

	static function getJsFooter()
	{
		return self::$jsFooter;
	}
	
	/**
	 * Agrega js's al footer del html
	**/
	static function addJsFooter($src="")
	{
		if ($src == "")
		{
			return;
		}
		self::$jsFooter[] = self::MakeJS($src);
	}

	//	
	static function getCss()
	{
		return self::$css;
	}

	/**
	 * Agrega css al header del html
	**/
	static function addCss($href="")
	{
		if ($href == "")
		{
			return;
		}
		self::$css[] = self::MakeCSS($href);
	}

	/**
	 * Elimina css al header del html
	**/
	static function removeCss($href="")
	{
		if ($href == "")
		{
			return;
		}
		$href = self::MakeCSS($href);
		foreach (self::$css as $key => $file)
		{
			if ($href == $file)
			{
				unset(self::$css[$key]);
			}
		}
	}

	/**
	 *
	 * @param string $href
	 * @return void|string
	**/
	static function MakeCSS($href)
	{
		//	If its an external file
		if (strpos($href, 'http') !== false)
		{
			return '<link href="'.$href.'" rel="stylesheet" type="text/css">';
		}
		return '<link href="'.self::$static.'css/'.$href.((""!=self::$refresh) ? '?upd='.self::$refresh : "").'" rel="stylesheet" type="text/css">';
	}

	/**
	 *
	 * @param string $src
	 * @return void|string
	**/
	static function MakeJS($src)
	{
		//	If its an external file
		if (strpos($src, 'http') !== false)
		{
			return '<script src="'.$src.'" type="text/javascript"></script>';
		}
		return '<script src="'.self::$static.'/js/'.$src.((""!=self::$refresh) ? '?upd='.self::$refresh : "").'" type="text/javascript"></script>';
	}

	//	
	static function init()
	{
		Setup::get();

		self::$static = url('statics').'/';

		view()->share([
			'ROOT'				=> url(),
			'STATICS'           => self::$static,
			'headers'           => self::getHeaders(),
			'NavbarProducts'	=> self::getProducts('navbar'),
			'NavbarExtra'		=> self::getNavbarExtra(),
			'FooterLinks'		=> self::getFooterLinks(),
		]);

		self::addCss('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
		self::addCss('jquery-ui/1.11.4/jquery-ui.min.css');
		self::addCss('main.css');
		self::addCss('details.css');
//		self::addCss('1200.css');

		self::addJsFooter('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js');
		self::addJsFooter('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
		self::addJsFooter('jquery/jquery.colorbox-min.js');
		self::addJsFooter('funciones.js');
		self::addJsFooter('lib/owl.carousel.min.js');
		self::addJsFooter('main.js');
	}

    //
    static function getHeaders()
    {
        $items = [];
        if (false==empty(Setup::$settings['header']))
        {
	        foreach (Setup::$settings['header'] as $key => $item)
	        {
	            if (true==$item['enabled'])
	            {
	                $items[] = $item;
	            }
	        }
		}
        return $items;
    }

    //
    static function getProducts($mode='navbar')
    {
        $items = [];
        if (false==empty(Setup::$settings['products']))
        {
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
	                    if (false == empty($item['css']))
	                    {
	                        foreach ($item['css'] as $css)
	                        {
	                        //    View::addCss($css);
	                        }
	                    }
	                    if (false == empty($item['js']))
	                    {
	                        foreach ($item['js'] as $js)
	                        {
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
        if (false==empty(Setup::$settings['navbar']))
        {
	        foreach (Setup::$settings['navbar'] as $key => $item)
	        {
	            if (true==$item['enabled'])
	            {
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
        if (false==empty(Setup::$settings['footer']))
        {
	        foreach (Setup::$settings['footer'] as $key => $footer)
	        {
	            if (true === $footer)
	            {
	                $items[$key] = true;
	                continue;
	            }
	            foreach ($footer as $item)
	            {
	                if (true==$item['enabled'])
	                {
	                    $items[$key][] = $item;
	                }
	            }
	        }
        }
        return $items;
    }
}

/**
 * Método para imprimir preformateado (Solo vagos)
 * @param mixed $datos.
 * @param bool $var_dump.
 * @param bool $exit.
**/
function print_pre($data, $var_dump=false, $exit=true) {
	if (!isset($data)) {
		print_r('The function print_pre() requires at least 1 parameter');
	}
	$var = ($var_dump) ? 'var_dump' : 'print_r';
	//	AJAX check
	if (Request::ajax()) {
		$var($data);
		$backtrace = debug_backtrace();
		$file = $backtrace[0]['file'];
		$line = $backtrace[0]['line'];
		echo "\nCalled from the file: {$file}, Line: {$line}\n";

		if ($exit) {
			exit('End.');
		}
	} else {
		echo ($var_dump) ? "" : '<pre>';
		$var($data);
		$backtrace = debug_backtrace();
		$file = $backtrace[0]['file'];
		$line = $backtrace[0]['line'];
		echo ($var_dump) ? "" : '</pre>';
		echo "Called from the file: {$file}, Line: {$line}<br><br>";

		if ($exit) {
			exit('<strong> End.</strong>');
		}
	}
}