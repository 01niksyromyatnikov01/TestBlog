<?php
/**
 * Created by PhpStorm.
 * User: niksy
 * Date: 10.07.2018
 * Time: 22:38
 */

namespace Kernel;


class User
{
    protected $id;

    protected $login;

    protected $level;

    protected $DB;

    protected $isAuth = false;

    protected $levels_arr = ["user","admin","editor"];

    function __construct(DB $DB)
    {
        $this->DB = $DB;

        if(isset($_COOKIE["id"]) && isset($_COOKIE["login"])) {
            $this->setSession($_COOKIE["id"],$_COOKIE["login"]);
            $this->isAuth = true;
        }
        if(isset($_SESSION["id"]) && isset($_SESSION["login"]) ) {
            $this->isAuth = true;

            $level = base64_decode($_SESSION["level"]);


            if(in_array($level,$this->levels_arr)) $this->level = $level;
            else {$this->level = "user"; $_SESSION["level"] = base64_encode("user");}
        }
    }


    function LogIn($login,$password,$remember_me = 0)
    {
        $password = $this->saltPassword($password);
        $query = ["table" => "users","wts" => "`id`,`level`", "where" => "WHERE `login` = '$login' AND `password` = '$password'"];
        $result = $this->DB->SELECT($query);
        if(!$result) return 0;
        $res = $this->DB->pushToArray($result);
        if($res["id"]) {
            $this->id = $res["id"];
            $this->login = $login;
            $this->level = $res["level"];
            $this->setSession();
            if($remember_me == 1) $this->setCookie();
            return $this->id;
        }
        return 0;
    }


    function createUser($login,$password)
    {
        $password = $this->saltPassword($password);
        $query = ["table" => "users","cells" => "(`login`,`password`)", "values" => "('$login','$password')"];
        $result = $this->DB->INSERT($query);
        if(!$result) return 0;
        $id = $this->DB->getLastId();
        if($id) {
            $this->id = $id;
            $this->login = $login;
            $this->setSession();
            $this->isAuth = true;
            return $this->id;
        }
        return 0;
    }


     function logOut() {
        $this->unsetSession();
        $this->unsetCookie();
        $this->isAuth = false;
    }

    protected function saltPassword($pass)
    {
        $pass  .= "saltsalt";
        return strrev(hash("sha256",$pass));
    }


    protected function setSession($params = [])
    {
        $id = $params["id"] ?? $this->id;
        $login = $params["login"] ?? $this->login;

        $_SESSION["id"] = $id;
        $_SESSION["login"] = $login;
        $_SESSION["level"] = base64_encode($this->level);
    }

    protected function setCookie($params = [])
    {
        $id = $params["id"] ?? $this->id;
        $login = $params["login"] ?? $this->login;

        setcookie("id",$this->id);
        setcookie("login",$this->login);
    }

    protected function unsetSession()
    {
        unset($_SESSION["id"]);
        unset($_SESSION["login"]);
    }

    protected function unsetCookie()
    {
        setcookie("id","");
        setcookie("login","");
    }

     function isAuthorized()
     {
        return $this->isAuth;
     }


    function getGroup()
    {
        return $this->level;
    }

    function isAdmin()
    {
        return $this->getGroup() === "admin";
    }

    function isEditor()
    {
        return $this->getGroup() === "editor";
    }



}