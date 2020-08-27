<?php


class User {

    public static function get_all_users(){
        global $database;
        $result_set = $database->query("SELECT * FROM users");
        return $result_set;
    }
    public static function get_user_by_id($user_id){
        global $database;
        $result_set = $database->query("SELECT * FROM users WHERE id = $user_id");
        return $result_set;
    }
    public static function get_user_by_pass($user_pass){
        global $database;
        $result_set = $database->query("SELECT * FROM users WHERE password = $user_pass");
        //$found_set= mysqli_fetch_array($result_set);
        return $result_set;
    }
}



?>