<?php namespace Controller;

use Service\Task AS TaskService;
use Lib\Core\Response;
use stdClass;

class Task
{
    private $method;
    private $obj;
    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->obj = new stdClass;
    }
    public function ListTask()
    {
        if($this->method == "GET")
        {
            TaskService::getInstance()->List();
        }
        else
        {
            Response::Bad(405,"Method Not Allowed");
        } 
    }
    public function AddTask()
    {
        if($this->method == "POST")
        {
            $body = file_get_contents("php://input");
            $body = json_decode($body);
            if(empty($body))
            {
                Response::Bad(400,"BAD REQUEST");
                return false;
            }

            $this->obj->title = isset($body->title) ? $body->title : null;
            $this->obj->description = isset($body->description) ? $body->description : null;
            TaskService::getInstance()->Add($this->obj);
        }
        else
        {
            Response::Bad(405,"Method Not Allowed");
        } 
    }
    public function EditTask()
    {
        if($this->method == "PUT")
        {
            $body = file_get_contents("php://input");
            $body = json_decode($body);
            if(empty($body))
            {
                Response::Bad(400,"BAD REQUEST");
                return false;
            }
            $this->obj->id = isset($body->id) ? $body->title : null;
            $this->obj->title = isset($body->title) ? $body->title : null;
            $this->obj->description = isset($body->description) ? $body->description : null;
            TaskService::getInstance()->Edit($this->obj);
        }
        else
        {
            Response::Bad(405,"Method Not Allowed");
        } 
    }
    public function RemoveTask()
    {
        if($this->method == "DELETE")
        {
            $id = isset($_GET["id"]) ? $_GET["id"] : null;
            TaskService::getInstance()->Remove($id);
        }
        else
        {
            Response::Bad(405,"Method Not Allowed");
        }     
    }
}