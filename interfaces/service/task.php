<?php namespace Interfaces\Service;

use stdClass;

interface Task
{
    function AddTask(stdClass $class);
    function LisTask();
    function EditTask(stdClass $class);
    function DeleteTask($id);
}