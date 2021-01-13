<?php namespace Interfaces\Service;

use stdClass;

interface Task
{
    function Add(stdClass $obj);
    function List();
    function Edit(stdClass $obj);
    function Remove($id);
}