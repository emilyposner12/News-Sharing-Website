<?php
require "database.php";
session_start();

if(!isset($_SESSION["username"])){
    echo("You must be logged in to upvote.");
    header("Location: newSiteLogin.php");
}
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	session_destroy();
	die("Request forgery detected, please login again");
}

$story_id = $_POST["story_id"];
$stmt = $mysqli->prepare("UPDATE posted_stories SET Likes = Likes - 1 WHERE Unq_Story_Id = ?");
if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}

$stmt->bind_param('i', $story_id);

if(!$stmt){
    printf("Query Prep Failed: %s\n", $mysqli->error);
    exit;
}
$stmt->execute();
$stmt->close();

echo("Downvoted!");
header("Refresh:2; url=displayPostedStories.php");
?>