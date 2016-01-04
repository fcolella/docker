<?php
/**
 * Created by PhpStorm.
 * User: gabrielvazquez
 * Date: 4/1/16
 * Time: 10:19
 */

namespace App\Http\Composers;

use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class ViewComposer
{
	public function compose(View $view)
	{
		view()->share([
			'ROOT'          => url(),
			'STATICS'       => Controller::$static,
			'headers'       => Controller::getHeaders(),
			'jsHeader'		=> Controller::$jsHeader,
			'cssTags'		=> Controller::$css,
			'jsFooter'		=> Controller::$jsFooter,
			'route'         => Controller::$route,
			'NavbarProducts'=> Controller::getProducts('navbar'),
			'NavbarExtra'   => Controller::getNavbarExtra(),
			'FooterLinks'   => Controller::getFooterLinks(),

			'CYBERMONDAY_TIME'=> false,
			'SHOW_TRAVEL_SALE_TAG'=> false,
		]);
	}
}