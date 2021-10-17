<?php
session_start();
require 'database.php';
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	session_destroy();
	die("Request forgery detected, please login again");
}

//set variables
$story_id=(int)$_POST['story_id'];
//want this in session or post?

$title = (string)$_POST['title'];
$body = (string)$_POST['body'];
$link = (string)$_POST['link'];

if($title == "" || $body == ""){
	echo "<p> Your updated story was not saved! Make sure to fill out the story title and body! </p>";
}
else{
	$stmt = $mysqli->prepare("UPDATE posted_stories SET Title = ?, Body = ?, Link = ? WHERE Unq_Story_Id = ?");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}

	$stmt->bind_param('sssi', $title, $body, $link, $story_id);

	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$stmt->execute();
	$stmt->close();
	echo "<p> Story updated and saved! </p>";
}
echo("Story ID: " .$story_id);
header("Refresh:2; url=userProfile.php");

//header('Location:displayPostedStories.php');
exit;


?>