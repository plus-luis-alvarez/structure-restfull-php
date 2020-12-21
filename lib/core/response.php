<?php namespace Lib\Core;

use stdClass;

class Response
{
    private static $obj;

    private static function init()
    {
        self::$obj = new stdClass;
    }
    private static function view(int $code)
    {
        http_response_code($code);
        echo json_encode(self::$obj);
    }

    public static function Ok(int $code,string $message,$data)
    {
        self::init();
        self::$obj->code = $code;
        self::$obj->message = $message;
        self::$obj->data = $data;
        self::view($code);
    }
    public static function Bad(int $code,string $error)
    {
        self::init();
        self::$obj->error = $error;
        self::view($code);
    }
}