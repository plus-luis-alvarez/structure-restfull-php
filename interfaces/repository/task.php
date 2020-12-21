<?php namespace Interfaces\Repository;

use stdClass;

interface Task
{
    function Create(stdClass $class);
    function Read();
    function Update(stdClass $class);
    function Delete($id);
}