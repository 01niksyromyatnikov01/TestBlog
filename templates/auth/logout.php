<?php
/**
 * Created by PhpStorm.
 * User: niksy
 * Date: 10.07.2018
 * Time: 21:28
 */



if(!$Kernel->get("User")->isAuthorized()) {header('Location:/'); exit();}

$Kernel->get("User")->logOut();

header('Location: /');
exit();

?>