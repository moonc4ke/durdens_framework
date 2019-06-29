<?php

namespace Core\Page;

class Router
{

    public static $routes = [];

    public static function addRoute($url, $controller_name)
    {
        self::$routes[$url] = $controller_name;
    }

    public static function getRouteController($url)
    {
        if (isset(self::$routes[$url])) {
            $class = self::$routes[$url];

            return new $class();
        }
    }

}
