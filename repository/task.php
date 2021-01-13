<?php namespace Repository;

use Interfaces\Repository\Task AS ITaskRepository;
use Lib\Core\Connection;
use stdClass;
use PDO;


class Task implements ITaskRepository
{
    private $cn;

    public function __construct()
    {
        $this->cn = Connection::getConnection();
    }
    public function Create(stdClass $obj)
    {
        $sql = "CALL USP_TASK_INSERT(:title,:description)";
        $stmt = $this->cn->prepare($sql);
        $stmt->bindParam(":title",$obj->title,PDO::PARAM_STR);
        $stmt->bindParam(":description",$obj->description,PDO::PARAM_STR); 
        $stmt->execute();
        $stmt = null;
        $this->cn = null; 
    }
    public function Read()
    {
        $sql = "CALL USP_TASK_GETALL";
        $stmt = $this->cn->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt = null;
        $this->cn = null;
        return $result;
    }
    public function Update(stdClass $obj)
    {
        $sql = "CALL USP_TASK_UPDATE(:id,:title,:description)";
        $stmt = $this->cn->prepare($sql);
        $stmt->bindParam(":id",$obj->id,PDO::PARAM_INT);
        $stmt->bindParam(":title",$obj->title,PDO::PARAM_STR);
        $stmt->bindParam(":description",$obj->description,PDO::PARAM_STR); 
        $stmt->execute();
        $stmt = null;
        $this->cn = null; 
    }
    public function Delete($id)
    {
        $sql = "CALL USP_TASK_DELETE(:id)";
        $stmt = $this->cn->prepare($sql);
        $stmt->bindParam(":id",$id,PDO::PARAM_STR); 
        $stmt->execute();
        $stmt = null;
        $this->cn = null; 
    }
}