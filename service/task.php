<?php namespace Service;

use stdClass;
use \Interfaces\Service\Task AS ITaskService;
use \Repository\Task AS TaskRepository;
use \Lib\Core\Response;

class Task implements ITaskService
{
    private $repository;
    private static $instance;

    private function __construct()
    {
        $this->repository = new TaskRepository();
    }
    public static function  getInstance()
    {
        if(!isset(self::$instance))
        {
            $class = __CLASS__ ;
            self::$instance = new $class();
        }
        return self::$instance;
    }

    function AddTask(stdClass $class)
    {
        if(empty($class->title))
        {
            Response::Bad(400,"Bad Request!");
            return;
        }
        if(empty($class->description))
        {
            Response::Bad(400,"Bad Request!");
            return;
        }
        $result = $this->repository->Create($class);

        Response::Ok(200,"Ok",$result);
    }

    public function LisTask()
    {
        Response::Ok(200,"Ok",$this->repository->Read());
    }

    function EditTask(stdClass $class)
    {
        if(empty($class->id))
        {
            Response::Bad(400,"Bad Request!");
            return;
        }
        if(empty($class->title))
        {
            Response::Bad(400,"Bad Request!");
            return;
        }
        if(empty($class->description))
        {
            Response::Bad(400,"Bad Request!");
            return;
        }
        $result = $this->repository->Update($class);

        Response::Ok(200,"Ok",$result);
    }

    function DeleteTask($id)
    {
        if(empty($id))
        {
            Response::Bad(400,"Bad Request!");
            return;
        }
        $result = $this->repository->Delete($id);

        Response::Ok(200,"Ok",$result);
    }
}