<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel = "stylesheet" href = "style.css">
    <title>Add Story</title>
</head>
<body>
<?php 

require 'database.php';
session_start();
?>

<h2> Add Your Own Post </h2>

<form action ="addStoryCheck.php" method="POST">
    <label> Title: </label>
    <input type="text" name="title" />
    <br>
    <br>
    <label> Body: </label>
    <input type="text" name="body"/>
    <br>
    <br>
    <label> Link (optional): </label>
    <input type="text" name="link"/>
    <br>
    <br>
    <label> Category (optional): </label>
    <select name = "categories" id = "categories">
    <option value="Entertainment">Entertainment</option>
    <option value="Tech">Tech</option>
    <option value="Sports">Sports</option>
    <option value="Events">Events</option>
    <option value="Campus Life">Campus Life</option>
    <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
    <input type="submit" name ="addStory"/>
</form>
<br>
<br>
<form method="POST" action="displayPostedStories.php">
    <input type="submit" value = "Return Home" />
</form>
</body> 
</html>


