<?php require_once("inti.php"); ?>

<?php


if ($session->is_signed_in()){
    redirect("index.php");
}

if (isset($_POST['submit'])){   
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
}

if ($user_found){
    $session->login($user_found);
    redirect("index.php");
}
else {
    $the_message = "Your username or password isn't correct";
}



?>