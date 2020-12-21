<?php namespace Helpers;


class Helpers
{

    public static function Test()
    {
        return "ok";
    }
    public static function getItems(string $uri)
    {
        $result = array();
        $uri = explode("/",$uri);
        $uri = array_map(function($item){
            $item = str_replace("-"," ",$item);
            $item = ucwords($item);
            $item = str_replace(" ","",$item);
            return $item;
        },$uri);
        foreach ($uri AS $item)
        {
            if(!empty($item))
            {
                array_push($result,$item);
            }
        }
        return $result;
    }
    public static function getController(string $controller)
    {
        $controller_lower = strtolower($controller);
        $controller_path = "controller/${controller_lower}.php";
        $controller_class = "\\Controller\\$controller";
        return [$controller_path,$controller_class];
    }
}