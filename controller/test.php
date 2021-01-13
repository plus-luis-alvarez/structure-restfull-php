<?php namespace Controller;

use Lib\Core\Response;

class Test
{
    public function __construct()
    {
        
    }

    public function Hello()
    {
        Response::Ok(200,"Hello Word",null);
    }
}