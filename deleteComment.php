<?php
session_start();
require 'database.php';
if(!hash_equals($_SESSION['token'], $_POST['token'])){
       session_destroy();
       echo $_POST['token'];
       die("Request forgery detected, please login again");
   }

$comment_id=(int)$_POST['comment_id'];

//delete comment from database
$stmt = $mysqli->prepare("DELETE FROM comments WHERE Unq_Comment_Id=?");

if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('i', $comment_id);
$stmt->execute();
$stmt->close();

header('location:userProfile.php');
exit;
?>