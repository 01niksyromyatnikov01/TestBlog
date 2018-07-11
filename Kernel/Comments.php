<?php
/**
 * Created by PhpStorm.
 * User: niksy
 * Date: 10.07.2018
 * Time: 19:27
 */

namespace Kernel;

class Comments implements ActionInterface
{

    protected $DB;

    function __construct(DB $DB)
    {
        $this->DB = $DB;
    }


    function get(array $params = []): array
    {
        if($params["id"]) $where = "where `post_id` = ".$params['id']."";
        else $where = "ORDER by `id` DESC";

        $query = ["table" => "comments", "wts" => "*","where" => $where];
        $result = $this->DB->SELECT($query);
        return $this->prepare($result);
    }


    function add(array $params): string
    {
        $query = ["table" => "comments", "cells" => "(`author`,`text`,`post_id`)","values" => "('".$params['author']."','".$params['text']."','".$params['post_id']."')"];
        $result = $this->DB->INSERT($query);
        if($result) return $this->DB->getLastId();
        else return "error";
    }

    function getAuthor(int $ent_id): string
    {
        if(intval($ent_id)) {
            $query = ["table" => "`comments`", "wts" => "author", "where" => "WHERE comments.`id` = " . $ent_id . ""];
            $result = $this->DB->SELECT($query);
            $res = $this->DB->pushToArray($result);
            return $res["author"];
        }
        else return "unknown";
    }

    function prepare($result): array
    {
        $res = array();

        while($row = $this->DB->pushToArray($result)) {$res[] = $row;}
        return $res;
    }


}