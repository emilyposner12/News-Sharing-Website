<?php
//include for all actions that need to post/delete/edit comments/stories 
//will use like: require 'getToken.php';
 if(!hash_equals($_SESSION['token'], $_POST['token'])){
     echo($_SESSION['token']. " session token");
     echo($_POST["token"]. " post token");
        session_destroy();
        die("Request forgery detected, please login again");
    }
?>

