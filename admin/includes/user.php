<?php


class User {
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;


    public static function get_all_users(){
        return self::get_query("SELECT * FROM users");
    }

    public static function get_user_by_id($user_id){
        $the_array = self::get_query("SELECT * FROM users WHERE id = $user_id");
        return !empty($the_array) ? array_shift($the_array) : false;
    }

    public static function get_user_by_pass($user_pass){
        $the_array = self::get_query("SELECT * FROM users WHERE password = $user_pass");
        return  $the_array;
    }
    public static function get_query($sql){
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array();
        while($row =  mysqli_fetch_array($result_set)){
            $the_object_array[] = self::instantation($row);
        }
        //$result_arr = mysqli_fetch_array($result_set);
        return $the_object_array;
    }

    public static function instantation($the_record){
        $the_object = new self();
        foreach($the_record as $key => $value){
            if ($the_object->has_the_key($key)){
                $the_object-> $key = $value;
            }
        }
        return $the_object;
    }

    private function has_the_key($key){
        // get all the properties in the user class
            $object_properties = get_object_vars($this);

        // check if the key is one of the properties in the user class
        return array_key_exists($key,$object_properties);

    }



}



?>