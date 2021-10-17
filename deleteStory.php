<?php
session_start();
require 'database.php';
if(!hash_equals($_SESSION['token'], $_POST['token'])){
        echo("TOKEN" . $_POST['token']);
       session_destroy();
       die("Request forgery detected, please login again");
   }


$story_id = $_POST['story_id'];

$stmt = $mysqli->prepare("DELETE FROM comments WHERE Story_Id=?");

if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt->bind_param('i', $story_id);
$stmt->execute();
$stmt->close();


$stmt2 = $mysqli->prepare("DELETE FROM posted_stories WHERE Unq_Story_Id=?");

if(!$stmt2){
    printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$stmt2->bind_param('i', $story_id);
$stmt2->execute();
$stmt2->close();

header('Location:displayPostedStories.php');
exit;
?>