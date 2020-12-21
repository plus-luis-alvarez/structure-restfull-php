<?php
include_once ("config/Globals.php");
include_once ("lib/core/autoload.php");
header("Content-Type:application/json");

use Helpers\Helpers AS helper;
use Controller\Error AS error;

$uri = $_SERVER["REQUEST_URI"];
$Array_item = helper::getItems($uri);

if(empty($Array_item))
{
    error::NotFound();
}
else
{
    $controller = $Array_item[0];

    $method = isset($Array_item[1]) ? $Array_item[1] : "Index";

    $param = isset($Array_item[2]) ? $Array_item[2] : null;

    if (is_numeric($method)){
        $param = $method;
        $method = "Index";
    }
    $Array_constroller = helper::getController($controller);
    $path = $Array_constroller[0];
    $class = $Array_constroller[1];

    if(is_readable($path))
    {
        if(method_exists($class,$method))
        {
            $obj = new $class;
            $obj->$method($param);
        }
        else
        {
            error::NotFound();
        }
    }
    else
    {
        error::NotFound();
    }
}