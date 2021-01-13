<?php namespace Lib\Core;

class Helpers
{

    public static function getItems($uri)
    {
        $list = explode("/",$uri);
        $list = array_map(function($item){
            $item = str_replace("-"," ",$item);
            $item = ucwords($item);
            $item = str_replace(" ","",$item);
            return $item;
        },$list);
        $result = array();

        foreach($list as $item)
        {
            if(!empty($item))
            {
                array_push($result,$item);
            }
        }
        return $result;
    }
    public static function getController()
    {
        
    }
}