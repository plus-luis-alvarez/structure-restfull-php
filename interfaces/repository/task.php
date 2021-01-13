<?php namespace Interfaces\Repository;

use stdClass;

interface Task
{
    function Create(stdClass $obj);
    function Read();
    function Update(stdClass $obj);
    function Delete($id);
}