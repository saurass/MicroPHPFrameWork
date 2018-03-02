<?php
/**
 * Created by PhpStorm.
 * User: Saurass
 * Date: 01-03-2018
 * Time: 23:12
 */
require __DIR__.'/../Controller/Controller.php';

class Route
{
    private function getSafeUri()
    {
        $data = [];
        $data[] = strip_tags($_SERVER['REQUEST_METHOD']);
        $data[] = trim(strip_tags($_SERVER['REQUEST_URI']),'/');
        return $data;
    }

    public static function get($uri, $control_function)
    {
        $route_obj = new Route();
        $data = $route_obj->getSafeUri();
        if (strtolower($data[0]) == 'get') {
            if (trim($uri,'/') == $data[1]) {
                $arr = explode('@', $control_function);
                $controller=$arr[0];
                $control = new $controller();
                $fun = $arr[1];
                $control->$fun();
            } else {
                die('Route Not Found !!');
            }
        } else {
            die('Invalid request method');
        }
    }
}