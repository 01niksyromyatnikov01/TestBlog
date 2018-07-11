<?php
/**
 * Created by PhpStorm.
 * User: niksy
 * Date: 10.07.2018
 * Time: 19:33
 */


namespace Kernel;


interface ActionInterface
{

    /** returns ass. array */
    function get(array $params = []) :array;

    /** returns string ID or entity data */
    function add(array $params) :string;

    /** returns Author name */
    function getAuthor(int $ent_id) :string;

    /** returns $result array after some preparations */
    function prepare($result) :array;


}