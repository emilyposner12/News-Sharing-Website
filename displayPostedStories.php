<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel = "stylesheet" href = "style.css">
    <title>Homepage</title>
  </head>
  <body>
    <h1> Welcome to The Night News Forum</h1>
    <?php
require 'database.php';
session_start();
if($_SESSION['isUser']){
	?>
<!-- form for adding stories -->
<div class = "row" style= "display:flex; flex-direction: row; justify-content: flex-start; align-items: center">
  <form action = "userProfile.php" method = "POST">
  <input type="submit" value="View Your Profile">
  </form>
  <form action ="addStory.php" method="POST">
  <input type="submit" name ="addStory" value = "Post Your Own Story"/>
<input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
</form>
 <!-- form for logging out -->
 <form action = "logoutModule3.php" method = "POST">
  <input type="submit" value="Logout">
  </form>
</div>
<?php
}
else {
printf("<p> Logged in as a guest </p>");
?>
 <div class = "row" style= "display:flex; flex-direction: row; justify-content: flex-start; align-items: center">
<!-- register new user -->
 <form action = "registrationPage.html" method = "POST">
  <input type="submit" value="New User Registration">
  </form>
  <!-- login -->
  <form action = "login.html" method = "POST">
  <input type="submit" value="Login">
  </form>
</div>
  <?php
}
?>
  <h4>Most Recent Articles</h4>
  <!-- searching by categories -->
  <form action ="searchByCatagory.php" method="POST">
    <label> Search by category: </label>
    <select name = "categories" id = "categories">
    <option value="Entertainment">Entertainment</option>
    <option value="Tech">Tech</option>
    <option value="Sports">Sports</option>
    <option value="Events">Events</option>
    <option value="Campus Life">Campus Life</option>
    <input type="submit" name ="search" value = "Search"/>
  </form>
<?php

$stmt = $mysqli->prepare("SELECT Unq_Story_Id, Title, Body, Link, Posted_By, Likes FROM posted_stories ORDER BY Unq_Story_Id DESC;");
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
    echo "<br>";
    echo "<div class = 'row' style= 'display:flex; flex-direction: row; justify-content: flex-start; align-items: center'><button id = 'button'><a href='viewComments.php?story_id=$id'>View Comments </a></button> <button id = 'button'><a href='addComments.php?story_id=$id'>Add Comment </a></button><form action ='upVote.php' method='POST'>
    <input type='submit' name ='upVote' value = 'Upvote'/>
    <input type='hidden' name='token' value='$token'/>
    <input type='hidden' name='story_id' value='$id'/>
  </form>
  <form action ='downVote.php' method='POST'>
  <input type='submit' name ='downVote' value = 'Downvote'/>
  <input type='hidden' name='token' value='$token'/>
  <input type='hidden' name='story_id' value='$id'/>
</form>
  </div>";
  /*
    echo "<button id = 'button'><a href='viewComments.php?story_id=$id'>View Comments </a></button>";
    echo "<button id = 'button'><a href='addComments.php?story_id=$id'>Add Comment </a></button>";
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
  */
    echo ("<hr>");
    echo("<br>");
}
$stmt->close();
  ?>
</body>
</html>