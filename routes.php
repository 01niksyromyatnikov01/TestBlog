<?php
/**
 * Created by PhpStorm.
 * User: niksy
 * Date: 27.12.2017
 * Time: 18:41
 */

date_default_timezone_set('Europe/Kiev');
define('MAIN_DIR', dirname(__FILE__));
session_start();


/** Classes Autoload */
require_once "autoload.php";

/**  Start  */
$Kernel = new Kernel\Kernel();

/**  Localization List */
$Local = $Kernel->Local->List;


/** inheritance from the global list */
/** anonymous function     */
$isAuth = function () use ($Kernel) {
    return $Kernel->get("User")->isAuthorized();
};

$isAdmin = function () use ($Kernel) {
    return $Kernel->get("User")->isAdmin();
};

$isEditor = function () use ($Kernel) {
    return $Kernel->get("User")->isEditor();
};

/*
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
*/



$url = explode("/",$_SERVER["REQUEST_URI"]);





// Languages
if($url[1] == 'en') {
    setcookie('lang','en');
    header("Location: ".$_SERVER['HTTP_REFERER']);
}
if($url[1] == 'ru') {
    setcookie('lang','ru');
    header("Location: ".$_SERVER['HTTP_REFERER']);
}



if($url[1] == 'index.html' || $url[1] == "index.php" || $url[1] == "") {
    require_once 'index.php';
}

if($url[1] == "post") {
    if (preg_match('#^[0-9]+$#', $url['2'])) include 'templates/post/post.php';

    if($isAuth() && ($isAdmin() || $isEditor() )) {
        if ($url[2] == "new") require_once 'templates/post/newpost.php';
        if ($url[2] == "add") require_once 'templates/post/addpost.php';
        if ($url[2] == "edit") require_once 'templates/post/edit.php';
        if ($url[2] == "delete") require_once 'templates/post/delete.php';
    }
    else header('Location:/'); exit();
}

if($url[1] == "auth") {
    if(!$isAuth()) {
        if ($url[2] == "login") require_once 'templates/auth/login.php';
        if ($url[2] == "signup") require_once 'templates/auth/signup.php';
    }
    else {
        if($url[2] == "logout") require_once 'templates/auth/logout.php';
        header('Location:/'); exit();
    }
    if($url[2] == "process") require_once 'templates/auth/process.php';

}



if($url[1] == "comments")
{
    if($url[2] == "get") require_once 'templates/comments/get.php';
    if($url[2] == "post") require_once 'templates/comments/post.php';
}





