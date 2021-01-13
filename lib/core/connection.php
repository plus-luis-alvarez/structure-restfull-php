<?php namespace Lib\Core;

use PDO;

class Connection
{
    public static function getConnection()
    {
        $cn = new PDO(CONNECTION_STRING,SERVER_USER,SERVER_PASS);
        return $cn;
    }
}