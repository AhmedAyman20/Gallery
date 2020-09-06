<?php




// __autoload function is a function that is used to include or require a file to the program so the program can run smoothly
function __autoload($class){

    $class = strtolower($class);
    $path  = "includes/{$class}.php";
    if (file_exists($path)){
        require_once($path);
    }
    else{
        die ("This file called {$path} doesn't exist");
    }
}

function redirect($location){
    header("Location:{$location}");
}















?>