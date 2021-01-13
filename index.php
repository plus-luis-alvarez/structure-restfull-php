<?php
require_once("config/Globals.php");
require_once("lib/core/autoload.php");
    
use Lib\Core\Helpers;
use Lib\Core\Response;


$uri = $_SERVER["REQUEST_URI"];

$items = Helpers::getItems($uri);


if(empty($items))
{
    Response::Bad(404,"Not Found");
}
else
{
    $controller = $items[0];
    $method = isset($items[1]) ? $items[1] : "Index";
    $path = "controller/".strtolower($controller).".php";
    if(is_readable($path))
    {
        $controller = "\\Controller\\".$controller;
        if(method_exists($controller,$method))
        {
            $obj = new $controller();
            $obj->$method();  
        }
        else
        {
            Response::Bad(404,"Not Method");
        }
    }
    else
    {
        Response::Bad(404,"Not Found"); 
    }
}





