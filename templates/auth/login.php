<?php
/**
 * Created by PhpStorm.
 * User: niksy
 * Date: 10.07.2018
 * Time: 21:28
 */


if($Kernel->get("User")->isAuthorized()) {header('Location:/'); exit();}
/**  Localization List */
$Local = $Kernel->Local->List;
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Log in</title>
    <link href="/css/signin.css" rel="stylesheet">
    <!-- Basic styles -->
    <?php require_once "templates/css.php"?>

</head>


<body>

<?php require_once "templates/header.php"?>



<main class="text-center">
    <?php
    if(isset($_SESSION["error"])) {
        echo "<div class='alert alert-danger' role='alert'>".$_SESSION["error"]."</div>";
        unset($_SESSION["error"]);
    }
    ?>
<form class="form-signin" action="process" method="post">
    <h1 class="h3 mb-3 font-weight-normal"><?php echo $Local['Please sign in']; ?></h1>
    <label for="inputName" class="sr-only"><?php echo $Local['Login']; ?></label>
    <input type="text" minlength="5" maxlength="25" name = "login" id="inputName" class="form-control" placeholder="<?php echo $Local['Login']; ?>" required autofocus>
    <label for="inputPassword" class="sr-only"><?php echo $Local['Password']; ?></label>
    <input type="password" minlength="5" maxlength="30" name="password" id="inputPassword" class="form-control" placeholder="<?php echo $Local['Password']; ?>" required>
    <input type="hidden" name="action" value="login"  class="form-control"  required>
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" name="remember_me" value="1"> <?php echo $Local['Remember me']; ?>
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo $Local['Sign in']; ?></button>
    <p class="mt-5 mb-3 text-muted"><a href="signup"><?php echo $Local['Sign Up']; ?></a></p>
</form>

</main>

