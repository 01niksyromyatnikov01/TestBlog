<?php


if(isset($_POST["title"]) && isset($_POST["description"]) && isset($_SESSION['id'])) {


    /** For quick images storing */
    $desc = base64_encode($_POST["description"]);

    $id = intval($_SESSION['id']);

    $title = strip_tags($_POST['title']);
    $title = htmlspecialchars($title);



    $id = $Kernel->get("Posts")->add(["title" => $title, "text" => $desc, "author" => $id]);

    header("Location: /post/".$id);
}