<?php

require_once ("init.php");

class Database{

    public $connection;

    function __construct(){
        $this->checking_my_connection();
    }
    public function checking_my_connection(){
//        $this->connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        if ($this->connection->connect_errno){                     // this checks if the connection has no errors
            die ("(this connection is not valid)" . $this->connection->connect_error);
        }
        else echo "TRUE";
    }

    public function query($sql){
        $result = $this->connection->query($sql);    //mysqli_query is a function that performs a query against a database
        return $result;
    }

    private function confirm_query($result){
        if (!$result) die("NO" . $this->connection->error);
    }

    public function escape_string ($string){
        //$escaped_string = mysqli_real_escape_string($this->connection , $string); //mysqli_real_escape_string
        $escaped_string = $this->connection->real_escape_string($string);
        return $escaped_string;
    }


}

$database = new Database();






?>