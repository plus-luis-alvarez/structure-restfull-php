<?php namespace Service;

use Interfaces\Service\Task AS ITaskService;
use Repository\Task AS TaskRepository;
use Lib\Core\Response;
use stdClass;

class Task implements ITaskService
{
    private $repository;
    private static $instance;

    private function __construct()
    {
        $this->repository = new TaskRepository;
    }

    public static function getInstance(){
        if(!isset(self::$instance))
        {
            $class = __CLASS__ ;
            self::$instance = new $class();
        }
        return self::$instance;
    }

    public function Add(stdClass $obj)
    {
        if(empty($obj->title))
        {
            Response::Bad(400,"Ingrese Titulo");
            return false;
        }
        if(empty($obj->description))
        {
            Response::Bad(400,"Ingrese Descripcion");
            return false;
        }
        $this->repository->Create($obj);
        Response::Ok(201,"Se Agrego Tarea!",null);
    }
    public function List()
    {
        $result = $this->repository->Read();
        Response::Ok(200,"List Task",$result);
    }
    public function Edit(stdClass $obj)
    {
        if(empty($obj->id))
        {
            Response::Bad(400,"Ingrese ID");
            return false;
        }
        if(empty($obj->title))
        {
            Response::Bad(400,"Ingrese Titulo");
            return false;
        }
        if(empty($obj->description))
        {
            Response::Bad(400,"Ingrese Descripcion");
            return false;
        }
        $this->repository->Update($obj);
        Response::Ok(200,"Se Edito Tarea!",null);
    }
    public function Remove($id)
    {
        if(empty($id))
        {
            Response::Bad(400,"Ingrese ID");
            return false;
        }
        $this->repository->delete($id);
        Response::Ok(200,"Se Elimino Tarea",null);
    }
}