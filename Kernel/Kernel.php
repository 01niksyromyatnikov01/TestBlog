<?php
/**
 * Created by PhpStorm.
 * User: niksy
 * Date: 09.07.2018
 * Time: 17:28
 */

/** Autoload function  */

namespace Kernel;

class Kernel {


    /** @var Lang  for the localization  */
    protected $Lang;


    protected $ClassList = [
        'Posts' => Posts::class,
        'Comments' => Comments::class,
        'User' => User::class,
    ];


    protected $objectArray = [

    ];

    private $DB;

    public $Local;

    function __construct()
    {
        $this->DB = new DB();

        $Lang = new Lang();

        $this->Lang = $Lang->getLang();

        $this->Local = new Localization($this->Lang);
    }


    function get($ObjectName)
    {
        if(!is_object($this->objectArray[$ObjectName])) {
            $ObjectName = "Kernel\\".$ObjectName;
            $this->objectArray[$ObjectName] = new $ObjectName($this->DB);}

        return $this->objectArray[$ObjectName];
    }

    function getLang() {
        return $this->Lang;
    }


}


