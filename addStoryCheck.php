<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title></title>
</head>
<body>

<div>
<?php
session_start();

require 'database.php';
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	   session_destroy();
	   die("Request forgery detected, please login again");
   }

if(!isset($_SESSION["username"])){
    echo("You must be logged in to add a story.");
    header('refresh:2 url=login.html');
    exit;
}

$title = (string)$_POST['title'];
$body = (string)$_POST['body'];
$link = (string)$_POST['link'];
$category = (string)$_POST['categories'];
$username = (string)$_SESSION['username'];
$Unq_Story_Id = 0; //always 0, auto increments based on highest value in table
if($title == "" || $body == "" || $link == ""){
	echo "<p> Story was not saved. Make sure to fill out the title and body. </p>";
}
else{
	$stmt = $mysqli->prepare("INSERT INTO posted_stories (Unq_Story_Id, Title, Body, Link, Posted_By, vendor_group) values (?, ?, ?, ?, ?, ?)");
    //in quotes or not in quotes?
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$stmt->bind_param('isssss', $Unq_Story_Id, $title, $body, $link, $username, $category);
	$stmt->execute();
	$stmt->close();
	echo "<p> Story successfully added. </p>";
}
?>

<form action="displayPostedStories.php" method="POST">
	<input type="submit" value="Return Home" />
	<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
</form>
<form action="addStory.php" method="POST">
	<input type="submit" value="Add Another Story" />
	<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
</form>
</div>
</body> 
</html>