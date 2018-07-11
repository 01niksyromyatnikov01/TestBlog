<?php



$json = array();

$json['result'] = 0;
$json['error'] = "comment was not found";

if(isset($url[3])) {
    if(preg_match('#^[0-9]+$#', $url[3]))  {

        $id = $url[3];

        $comments = $Kernel->get("Comments")->get(["id" => $id]);
        if($comments[0]) $json["result"] = $comments;
        $json["error"] = 0;

    }
}

echo json_encode($json);

