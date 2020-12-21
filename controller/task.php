<?php namespace Controller;

use Lib\Core\Response;
use Service\Task AS TaskService;
use stdClass;

class Task
{
    private $method;
    private $body;
    public function __construct()
    {
        $this->method = $_SERVER["REQUEST_METHOD"];
        $this->body = file_get_contents("php://input");
    }

    public function Index($param = null)
    {
        if($this->method == "GET")
        {
            TaskService::getInstance()->LisTask();
        }
        else if($this->method == "POST")
        {
            $body = json_decode($this->body);
            if(empty($body))
            {
                Response::Bad(400,"Bad Request");
                return;
            }

            $obj = new stdClass;
            $obj->title = isset($body->title) ? $body->title : null;
            $obj->description = isset($body->description) ? $body->description : null;
            TaskService::getInstance()->AddTask($obj);
        }
        else if($this->method == "PUT")
        {
            if(empty($param))
            {
                Response::Bad(400,"Bad Request");
                return;
            }
            $body = json_decode($this->body);
            if(empty($body))
            {
                Response::Bad(400,"Bad Request");
                return;
            }

            $obj = new stdClass;
            $obj->id = $param;
            $obj->title = isset($body->title) ? $body->title : null;
            $obj->description = isset($body->description) ? $body->description : null;
            TaskService::getInstance()->EditTask($obj);
        }
        else if($this->method == "DELETE")
        {
            if(empty($param))
            {
                Response::Bad(400,"Bad Request!");
                return;
            }
            TaskService::getInstance()->DeleteTask($param);
        }
        else
        {
            Response::Bad(400,"Bad Request!");
        }
    }
}