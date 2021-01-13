<?php namespace Lib\Core;

use stdClass;

class Response
{
    private static $obj;

    private static function Init()
    {
        self::$obj = new stdClass;
    }
    private static function view($code)
    {
        header("Content-Type:application/json");
        http_response_code($code);
        echo json_encode(self::$obj);
    }

    public static function Ok($code,$message,$data)
    {
        self::Init();
        self::$obj->code = $code;
        self::$obj->message = $message;
        self::$obj->data = $data;
        self::view($code);
    }
    public static function Bad($code,$error)
    {
        self::Init();
        self::$obj->code = $code;
        self::$obj->error = $error;
        self::view($code);
    }
}
