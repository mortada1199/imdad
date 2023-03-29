<?php
namespace App\utils;



class PathParameter
{
protected static $MAIN_PATH = 'api/v1_0/';

public function getPath()
{
    return $this->MAIN_PATH;
}
}
