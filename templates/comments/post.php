<?php
/**
 * Created by PhpStorm.
 * User: niksy
 * Date: 10.07.2018
 * Time: 21:28
 */



$json = array();

$json['result'] = 0;
$json['error'] = "Failed to store comment";


    if(isset($_POST["name"]) && isset($_POST["text"]) && isset($_POST["post_id"]))  {

        $name = htmlspecialchars($_POST["name"]);
        $text = htmlspecialchars($_POST["text"]);
        $post_id = htmlspecialchars($_POST["post_id"]);

        if(preg_match('#^[0-9]+$#',$post_id)) {
            $comment_id = $Kernel->get("Comments")->add(["post_id" => $post_id, "author" => $name, "text" => $text]);

            if ($comment_id > 0) {
                $json["result"] = ["author" => $name,"text" => $text, "post_id" => $post_id,"comment_id" => $comment_id];
                $json["error"] = 0;
            }
        }
    }


echo json_encode($json);

