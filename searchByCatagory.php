<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel = "stylesheet" href = "style.css">
    <title>Category</title>
  </head>
  <body>
<?php
require "database.php";
session_start();
$category = $_POST["categories"];
$stmt = $mysqli->prepare("SELECT Unq_Story_Id, Title, Body, Link, Posted_By, vendor_group, Likes FROM posted_stories WHERE vendor_group ='" .$category."';");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->execute();

$result = $stmt->get_result();
$token = $_SESSION["token"];
while($row = $result->fetch_assoc()){
	echo(htmlspecialchars($row["Title"]));
    echo(" ");
    echo("<br>");
    echo(htmlspecialchars($row["Body"]));
    echo(" ");
    $storyLink = htmlspecialchars($row["Link"]);
    $id = $row["Unq_Story_Id"];
    echo '<br><b>See full story at: </b><a href="https://' . $storyLink . '" target="_blank">' . $storyLink . '</a>';
    echo "<br>";
    echo "<b>Likes: </b>" .($row["Likes"]);
    echo "<br>";
    echo "<button id = 'viewComments'><a href='viewComments.php?story_id=$id'>View Comments </a></button>";
    echo "<button id = 'addComments'><a href='addComments.php?story_id=$id'>Add Comment </a></button>";
    echo "<form action ='upVote.php' method='POST'>
    <input type='submit' name ='upVote' value = 'Upvote'/>
    <input type='hidden' name='token' value='$token'/>
    <input type='hidden' name='story_id' value='$id'/>
  </form>";
  echo "<form action ='downVote.php' method='POST'>
    <input type='submit' name ='downVote' value = 'Downvote'/>
    <input type='hidden' name='token' value='$token'/>
    <input type='hidden' name='story_id' value='$id'/>
  </form>";
    echo ("<hr>");
    echo("<br>");
}
$stmt->close(); 
?>
<form method="POST" action="displayPostedStories.php">
    <input type="submit" value = "Go Back" />
  </form>
  </body>
</html>