<?php namespace Controller;

use Lib\Core\Response;

class Error
{
    public static function NotFound()
    {
        Response::Bad(400,"Bad Request");
    }
}