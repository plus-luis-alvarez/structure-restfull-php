<?php namespace Repository;

use \Interfaces\Repository\Task AS ITaskRepository;
use stdClass;
use PDO;
use \Lib\Core\Connection;

class Task implements ITaskRepository
{
    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }
    function Create(stdClass $class)
    {
        $sql = "CALL USP_TASK_INSERT(:title,:description)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":title",$class->title,PDO::PARAM_STR);
        $stmt->bindParam(":description",$class->description,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ)[0];
        $stmt = null;
        $this->connection = null;

        return $result;
    }

    function Read()
    {
        $sql = "CALL USP_TASK_GETALL";
        $stmt =  $this->connection->query($sql);
        $resutl = $stmt->fetchAll(PDO::FETCH_OBJ);
        $stmt = null;
        $this->connection = null;
        return $resutl;
    }

    function Update(stdClass $class)
    {
        $sql = "CALL USP_TASK_UPDATE(:id,:title,:description)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id",$class->id,PDO::PARAM_INT);
        $stmt->bindParam(":title",$class->title,PDO::PARAM_STR);
        $stmt->bindParam(":description",$class->description,PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ)[0];
        $stmt = null;
        $this->connection = null;

        return $result;
    }

    function Delete($id)
    {
        $sql = "CALL USP_TASK_DELETE(:id)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ)[0];
        $stmt = null;
        $this->connection = null;
        return $result;
    }
}