<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel = "stylesheet" href = "style.css">
    <title>User Profile</title>
  </head>
  <body>
    <br>
    <?php
require 'database.php';
session_start();
$username = $_SESSION['username'];
$stmt = $mysqli->prepare("SELECT * FROM posted_stories WHERE Posted_By= '$username'");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->execute();

$result = $stmt->get_result();
$token = $_SESSION['token'];
echo("<div class = 'row' style= 'display:flex; flex-direction: row; justify-content: flex-start; align-items: center'><h1> Welcome to Your User Profile </h1><form method='POST' action='displayPostedStories.php'>
<input type='submit' value = 'Go Back'/></form></div>");

echo("<h2> Your Posts: </h2>");
while($row = $result->fetch_assoc()){
	echo(htmlspecialchars($row["Title"]));
    echo(" ");
    echo("<br>");
    echo(htmlspecialchars($row["Body"]));
    echo(" ");
    $storyLink = htmlspecialchars($row["Link"]);
    $id = $row["Unq_Story_Id"];
    echo '<br><b>See full story at: </b><a href="https://' . $storyLink . '" target="_blank">' . $storyLink . '</a>';
    echo("<br>");
    echo "<b>Likes: </b>" .($row["Likes"]);
    echo "<br>";
    echo "<br>";
    echo ("<div class = 'row' style= 'display:flex; flex-direction: row; justify-content: flex-start; align-items: center'><form action ='editStory.php' method='POST'>
    <input type='submit' name ='editStory' value = 'Edit Story'/>
    <input type='hidden' name='token' value='$token'/>
    <input type='hidden' name='story_id' value='$id'/>
    </form>
    <form action ='deleteStory.php' method='POST'>
    <input type='submit' name ='deleteStory' value = 'Delete Story'/>
    <input type='hidden' name='token' value='$token'/>
    <input type='hidden' name='story_id' value='$id'/>
    </form></div>");
    echo("<br>");
    echo ("<hr>");   
}
$stmt->close();


$stmt1 = $mysqli->prepare("SELECT * FROM comments WHERE Username='$username'");
if(!$stmt1){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt1->execute();
$result1 = $stmt1->get_result();
echo("<h2> Your Comments: </h2>");
while($row = $result1->fetch_assoc()){
	echo(htmlspecialchars($row["Comment"]));
    echo(" ");
    $commentid = $row["Unq_Comment_Id"];
    echo "<br>";
    echo "<br>";
    echo ("<div class = 'row' style= 'display:flex; flex-direction: row; justify-content: flex-start; align-items: center'><form action ='editComment.php' method='POST'>
    <input type='submit' name ='editComment' value = 'Edit Comment'/>
    <input type='hidden' name='token' value='$token'/>
    <input type='hidden' name='comment_id' value='$commentid'/>
    </form>
    <form action ='deleteComment.php' method='POST'>
    <input type='submit' name ='deleteComment' value = 'Delete Comment'/>
    <input type='hidden' name='token' value='$token'/>
    <input type='hidden' name='comment_id' value='$commentid'/>
    </form></div>");
    echo("<br>");
    echo ("<hr>");
}
$stmt1->close();
  ?>
</body>
</html>