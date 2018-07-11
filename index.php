<?php

$User = $Kernel->get("User");

$Post = $Kernel->get("Posts");

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>My Test Blog</title>

      <?php require_once "templates/css.php"?>

  </head>

  <body>

  <?php require_once "templates/header.php"?>



    <main>

        <?php
        if($User->isAdmin() || $User->isEditor())
        echo '<div class="button-block">'
            .'<a href="post\new">'
                .'<button class="btn btn-outline-warning">'.$Local["addPost"].'</button>'
            .'</a>'
        .'</div>';
         ?>
        <br>

        <div class="list-group posts-list">
        <?php
        $posts = array();

        $posts = $Post->get();

        //print_r($posts);

        foreach ($posts as $post) {
            echo "<li class='list-group-item d-flex justify-content-between align-items-center'>"
                ."<span><strong>".$post["title"]."</strong></span>"
                ."<br><span>".$Post->substr($post["text"])."<a class='read_link' href='post\\".$post['id']."'>...".$Local['readMore']."</a></span>"
                ."</li>"."<br>";
        }

        ?>
        </div>

    </main>


<?php require_once "templates/footer.php"?>