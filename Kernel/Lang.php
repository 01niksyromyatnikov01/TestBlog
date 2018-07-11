<?php
/**
 * Created by PhpStorm.
 * User: niksy
 * Date: 09.07.2018
 * Time: 19:16
 */

namespace Kernel;


class Lang
{
    protected $lang;

    function __construct()
    {
        $this->lang = $_COOKIE['lang'] ?? "ru";
    }


    function getLang() :string
    {
        return $this->lang;
    }

}