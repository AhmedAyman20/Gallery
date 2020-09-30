<?php


class Photo extends Db_object{

    protected static $db_table = "photos";
    protected static $db_table_fields = array ('photo_id' , 'title' , 'description' , 'filename' , 'type' , 'size');
    public $id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size;

    public $tmp_path ;
    public $uploaded_directory = "images";
    public $errors = array();
    public $upload_errors_array = array(

    0 => "There is no error",
    1 => "Bigger than the upload_max_filesize directive",
    2 => "The uploaded file exceeds the MAX_FILE_SIZE",
    3 => "The uploaded file was only partially uploaded",
    4 => "No file was uploaded",
    6 => "Missing a temporary folder",
    7 => "Failed to write file to disk",
    8 => "A PHP extension stopped the file upload",

    );

    public function set_file($file){
        if (empty($file) || !$file || !is_array($file)){
            $this->errors[] = "There was no file uploaded here";
            return false;
        }
        elseif ($file['error'] != 0){
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;

        }
        else{
            $this->filename = basename($file['name']);   //basename just make the file name clean
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }


    }

    public function picture_path(){
//      return SITE_ROOT.DS.'admin'.DS.$this->uploaded_directory.DS.$this->filename;
        //return IMAGES_PATH . '/' . $this->uploaded_directory. '/' .$this->filename;
        return $this->uploaded_directory.DS.$this->filename;
    }



    public function save(){
        if ($this->photo_id){
            $this->update();
        }
        else{
            if(!empty($this->errors)){
                return false;
            }
            if(empty($this->filename) || empty($this->tmp_path)){
                $this->errors[] = "the file was not available";
                return false;
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->uploaded_directory . DS . $this->filename;

            if (file_exists($target_path)){
                $this->errors[] = "The file {$this->filename} already exists";
                return false;
            }

            if (move_uploaded_file($this->tmp_path , $target_path)){
                if ($this->create()) {
                    unset($this->tmp_path);
                    return true;
                }
            }
            else{
                $this->errors[] = "The file directory probably does not have permission";
                return false;
            }
        }

    }


    public function delete_photo(){
        if ($this->delete()){
            $target_path = SITE_ROOT.DS. 'admin' . DS . $this->picture_path();
            return unlink($target_path) ? true : false;
        }
        else{
            return false;
        }
    }

}

?>