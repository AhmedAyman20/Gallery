<?php


class User {

    protected static $db_table = "users";
    protected static $db_table_fields = array ('username' , 'password' , 'first_name' , 'last_name');
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;


    public static function get_all(){
        return self::get_query("SELECT * FROM " .self::$db_table . " ");
    }

    public static function get_user_by_id($user_id){
        $the_array = self::get_query("SELECT * FROM " .self::$db_table . " WHERE id = $user_id");
        return !empty($the_array) ? array_shift($the_array) : false;
    }

    public static function get_user_by_pass($user_pass){
        $the_array = self::get_query("SELECT * FROM " .self::$db_table . " WHERE password = $user_pass");
        return !empty($the_array) ? array_shift($the_array) : false;
    }



    public static function verify_user($username , $password){
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " .self::$db_table . " WHERE ";
        $sql .= "username = '{$username}' ";
        $sql .= "AND password = '{$password}' ";
        $sql .= "LIMIT 1";

        $the_array = self::get_query("$sql");
        return !empty($the_array) ? array_shift($the_array) : false;

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

    protected function properties(){
        global $database;
        $properties = array();
        foreach (self::$db_table_fields as $db_field){
            if (property_exists($this , $db_field)){
                $properties[$db_field] = $database->escape_string($this->$db_field);
            }
        }

        return $properties;
    }

    public function save(){
        return ($this->id) ? $this->update() : $this->create();
    }

    public function create(){
        global $database;

        $properties = $this->properties();

        // implode is equal to split in python
        $sql = "INSERT INTO " .self::$db_table . "(". implode(",",array_keys($properties)). ")";
        $sql .= "VALUES ('" . implode("','",array_values($properties)). "')" ;

        if ($database->query($sql)){

            $this->id = $database->the_insert_id();
            return true;
        }
        else{
             return false;
        }

    }

    public function update(){
        global $database;

        $properties = $this->properties();

        $properties_pairs = array();

        foreach ($properties as $key => $value){
            $properties_pairs[] = "{$key}='{$value}'";
        }


        $sql = "UPDATE " .self::$db_table . " SET ";
        $sql .= implode(", " , $properties_pairs);
        $sql .= " WHERE id= " . $database->escape_string($this->id);

        $database->query($sql);

        // The affected_rows / mysqli_affected_rows() function returns the number of affected rows
        // in the previous SELECT, INSERT, UPDATE, REPLACE, or DELETE query.
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    public function DELETE(){
        global $database;

        $sql = "DELETE FROM " .self::$db_table . " ";
        $sql .= " WHERE id=" . $database->escape_string($this->id);
        $sql .= " LIMIT 1";

        $database->query($sql);

        // The affected_rows / mysqli_affected_rows() function returns the number of affected rows
        // in the previous SELECT, INSERT, UPDATE, REPLACE, or DELETE query.
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }


}

$user = new User();



?>