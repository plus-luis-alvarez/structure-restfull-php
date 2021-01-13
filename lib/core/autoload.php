<?php

spl_autoload_register(function($class){
    $url = str_replace("\\","/","${class}.php");
    $url = strtolower($url);
    if(is_readable($url))
    {
        include_once("${url}");
    }
});