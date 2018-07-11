<?php
/**
 * Created by PhpStorm.
 * User: niksy
 * Date: 09.07.2018
 * Time: 17:28
 */

/** Autoload function  */


function __autoload($classname) {
    $filename = "./". $classname .".php";
    include_once($filename);
}





