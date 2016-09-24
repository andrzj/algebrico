<?php

namespace App\Helpers;

class Menu {
	public static function isActiveRoute($route, $output = "active")
	{
		$rt = \Route::currentRouteName();
		if (strpos($rt, $route) !== false) return $output;
	    //if (\Route::currentRouteName() == $route) return $output;
	}

	public static function areActiveRoutes(Array $routes, $output = "active")
	{
	    foreach ($routes as $route)
	    {
	        if (Route::currentRouteName() == $route) return $output;
	    }
	}

	public static function teste($rt){
		//dd(\Route::getGroupStack());
		//return (\Route::has($rt)) ? "opa" : "";
	}
}
