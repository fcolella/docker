<?php
/**
 * Created by PhpStorm.
 * User: gabrielvazquez
 * Date: 18/12/15
 * Time: 14:41
**/

namespace App\Http\Controllers\Home;

class Setup {
    //
    static $settings = [];
    //
    static function get()
    {
        require 'config/general.php';
        self::$settings = $settings;
        unset($settings);
        //
        if (is_readable( __dir__.'/config/'.getenv('APP_ENV').'.php' ))
        {
            include __dir__.'/config/'.getenv('APP_ENV').'.php';
            self::$settings = array_replace_recursive(self::$settings, $settings);
        }
        return self::$settings;
    }
}