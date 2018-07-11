<?php
/**
 * Created by PhpStorm.
 * User: niksy
 * Date: 10.07.2018
 * Time: 21:28
 */


if(isset($_POST['action'])) {
    $action = $_POST['action'];

    $User = $Kernel->get("User");

    if ($action === "login") {
        if (isset($_POST['login']) && isset($_POST['password'])) {

            $login = htmlspecialchars($_POST['login']);
            $password = htmlspecialchars($_POST['password']);
            $remember_me = htmlspecialchars($_POST['remember_me']);

            if (strlen($login) >= 5 && strlen($password) >= 5 && strlen($login) <= 25 && strlen($password) <= 30) {
                $result = $User->logIn($login, $password, $remember_me);
                if ($result > 0) {
                    header("Location: /");
                    exit();
                }
            } else {
                $_SESSION["error"] = $Local["login and pass length"];
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
            $_SESSION["error"] = $Local["failed to log in"];
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();

    }
    else if ($action === "signup") {
        if (isset($_POST['login']) && isset($_POST['password'])) {

            $login = htmlspecialchars($_POST['login']);
            $password = htmlspecialchars($_POST['password']);

            if (strlen($login) >= 5 && strlen($password) >= 5 && strlen($login) <= 25 && strlen($password) <= 30) {
                $result = $User->createUser($login, $password);
                if ($result > 0) {
                    $_SESSION["success"] = $Local["sign up success"];
                } else {
                    $_SESSION["error"] = $Local["sign up failed"];
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                    exit();
                }
            } else {
                $_SESSION["error"] = $Local["login and pass length"];
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
    }


}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Successful</title>
    <link href="/css/signin.css" rel="stylesheet">
    <!-- Basic styles -->
    <?php require_once "templates/css.php"?>

</head>


<body>

<?php require_once "templates/header.php"?>



<main class="text-center">
    <?php
    if(isset($_SESSION["success"])) {
        echo "<div class='alert alert-success' role='alert'>".$_SESSION["success"]."</div>";
        unset($_SESSION["success"]);
    }
    ?>
</main>
