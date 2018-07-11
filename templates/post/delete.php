<?php

$id = htmlspecialchars($url[3]);

$json["error"] = "unknown error";
$json["result"] = 0;

if( isset($_SESSION['id']) && isset($_SESSION['login']) && is_numeric($id)) {

    $user_id = htmlspecialchars($_SESSION['id']);
    $user_id = intval($user_id);

    if($Kernel->get("Posts")->delete(["author_id" => $user_id,"id" => $id])) {
        $json["result"] = "successfully deleted";
        $json["error"] = 0;
    }
    else $json["error"] = "failed to delete";
}

echo json_encode($json);