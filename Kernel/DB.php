<?php
/**
 * Created by PhpStorm.
 * User: niksy
 * Date: 09.07.2018
 * Time: 17:55
 */


namespace Kernel;

class DB {

    private $con;

    function __construct()
    {
        /** DB connection */
        $this->con = new \mysqli('localhost', '', '', 'blogTest');

        if (mysqli_connect_errno()) {
            printf("Connection failed. Err code: %s\n", mysqli_connect_error());
            exit;
        }
    }




    function SELECT($query) {
        $request = 'SELECT '.$query['wts'].' FROM '.$query['table'].' ';
        if(isset($query['where'])) {$request .= $query['where'];}
        $result = mysqli_query($this->con,$request) or  new \Exception("Error while SELECT");
        return $result;
    }

    function INSERT($query) {
        $request = 'INSERT INTO  '.$query['table'].' ';
        if(isset($query['cells']) AND isset($query['values'])) {$request .= $query['cells'].' VALUES '.$query['values'];}
        else throw new \Exception("Null cells or values");
        $result = mysqli_query($this->con,$request) or new \Exception("Error while INSERT");
        return $result;
    }

    function UPDATE($query) {
        $request = 'UPDATE  '.$query['table'].' SET ';
        if(isset($query['values'])) {$request .= $query['values'];}
        else throw new \Exception("Null cells or values");
        if(isset($query['where'])) {$request .= ' WHERE '.$query['where'];}
        $result = mysqli_query($this->con,$request) or new \Exception("Error while UPDATE");
        return $result;
    }

    function DELETE($query) {
        $request = 'DELETE  FROM '.$query['table'].' ';
        if(isset($query['where'])) {$request .= 'WHERE '.$query['where'];}
        else throw new \Exception("No WHERE case were found");
        $result = mysqli_query($this->con,$request) or  new \Exception("Error while DELETE");
        return $result;
    }

    function pushToArray($query) {
        if($query) { $result = mysqli_fetch_assoc($query); return $result; }
        else {throw new \Exception("Result is not TRUE"); }
    }

    function getLastId() {
        return mysqli_insert_id($this->con);
    }

    function getLastAffectedId() {
        return mysqli_affected_rows($this->con);
    }


    function __destruct()
    {
        $this->con->close();
    }

}