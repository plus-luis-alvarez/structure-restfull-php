<?php


namespace Controller;


use Lib\Core\Response;

class Test
{
    public function __construct()
    {

    }

    public function Index()
    {
        Response::Ok(200,"Ok","Test Controller");
    }
}