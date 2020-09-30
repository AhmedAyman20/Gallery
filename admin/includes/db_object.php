<?php


class Db_object {

    protected static $db_table = "photos";
    
    public static function find_all(){
        return static::find_by_query("SELECT * FROM " .static::$db_table . " ");
    }

    public static function find_by_id($id){
        $the_array = static::find_by_query("SELECT * FROM " .static::$db_table . " WHERE id = $id");
        return !empty($the_array) ? array_shift($the_array) : false;
    }

    public static function get_by_pass($user_pass){
        $the_array = static::find_by_query("SELECT * FROM " .static::$db_table . " WHERE password = $user_pass");
        return !empty($the_array) ? array_shift($the_array) : false;
    }

    public static function find_by_query($sql){
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array();
        while($row =  mysqli_fetch_array($result_set)){
            $the_object_array[] = static::instantation($row);
        }
        //$result_arr = mysqli_fetch_array($result_set);
        return $the_object_array;
    }


    public static function instantation($the_record){

        $calling_class = get_called_class();
        $the_object = new $calling_class;
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
        foreach (static::$db_table_fields as $db_field){
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
        $sql = "INSERT INTO " .static::$db_table . "(". implode(",",array_keys($properties)). ")";
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


        $sql = "UPDATE " .static::$db_table . " SET ";
        $sql .= implode(", " , $properties_pairs);
        $sql .= " WHERE id= " . $database->escape_string($this->id);

        $database->query($sql);

        // The affected_rows / mysqli_affected_rows() function returns the number of affected rows
        // in the previous SELECT, INSERT, UPDATE, REPLACE, or DELETE query.
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

    public function DELETE(){
        global $database;

        $sql = "DELETE FROM " .static::$db_table . " ";
        $sql .= " WHERE id=" . $database->escape_string($this->id);
        $sql .= " LIMIT 1";

        $database->query($sql);

        // The affected_rows / mysqli_affected_rows() function returns the number of affected rows
        // in the previous SELECT, INSERT, UPDATE, REPLACE, or DELETE query.
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }

}




?>