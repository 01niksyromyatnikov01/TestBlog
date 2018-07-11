<?php
/**
 * Created by PhpStorm.
 * User: niksy
 * Date: 09.07.2018
 * Time: 17:51
 */

namespace Kernel;


class Posts  implements ActionInterface
{

    protected $DB;

    protected $Substr;

    function __construct(DB $DB)
    {
     $this->DB = $DB;

     $this->Substr = Substr::class;
    }



    function get(array $params = []) :array
    {
        if($params["id"]) $where = "where `id` = ".$params['id']."";
        else $where = "ORDER by `id` DESC";

        $query = ["table" => "posts", "wts" => "*","where" => $where];
        $result = $this->DB->SELECT($query);
        return $this->prepare($result);
    }

    function add(array $params) :string
    {
        $query = ["table" => "posts", "cells" => "(`title`,`text`,`author`)","values" => "('".$params['title']."','".$params['text']."','".$params['author']."')"];
        $result = $this->DB->INSERT($query);
        if($result) return $this->DB->getLastId();
        else return "error";
    }

    function update(array $params) :bool
    {
        $query = ["table" => "posts", "values" => "`title` = '".$params['title']."', `text` ='".$params['text']."'", "where" => "`id` = ".$params['id'].""];
        $result = $this->DB->UPDATE($query);
        if($result) return $this->DB->getLastAffectedId() == 1;
        return false;
    }

    function delete(array $params) :bool
    {
        $query = ["table" => "posts", "where" => "`author` = ".$params['author_id']." AND `id` = ".$params['id'].""];
        $result_1 = $this->DB->DELETE($query);
        $query = ["table" => "posts", "wts" => "`id`", "where" => "Where `id` = ".$params['id'].""];
        $result = $this->DB->SELECT($query);
        $res = $this->DB->pushToArray($result);
        return !$res["id"];
    }


    function getAuthor(int $ent_id) :string  // ent_id - entity
    {
        if(intval($ent_id)) {
            $query = ["table" => "`users`", "wts" => "login", "where" => " WHERE users.`id` = (SELECT `author` FROM `posts` WHERE posts.`id` = " . $ent_id . ")"];
            $result = $this->DB->SELECT($query);
            $res = $this->DB->pushToArray($result);
            if($res["login"]) return $res["login"];
            return "deleted";
            }
        else return "admin";
    }


    function prepare($result) :array
    {
        $res = array();

        while($row = $this->DB->pushToArray($result)) {$row["text"] = base64_decode($row["text"]);$res[] = $row;}
        return $res;
    }


    function substr($str) {
        return new $this->Substr($str);
    }

}