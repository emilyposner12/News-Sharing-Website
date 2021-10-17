<?php
session_start();
$_SESSION['story_id']=(int)$_POST['story_id'];

require 'database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel = "stylesheet" href = "style.css">
    <title>Edit Your Post </title>
</head>
<body>
    <h1> Edit Your Post </h1>
    <form action="editStoryCheck.php" method="POST">
        <label> New Title: </label>
        <input type="text" name="title" required>
        <br>
        <br>
        <label> New Text: </label>
        <input type="text" name="body" required>
        <br>
        <br>
        <label> New Link (optional): </label>
        <input type="text" name="link">
        <br>
        <br>
        <label> Category (optional): </label>
        <select name = "categories" id = "categories">
        <option value="Entertainment">Entertainment</option>
        <option value="Tech">Tech</option>
        <option value="Sports">Sports</option>
        <option value="Events">Events</option>
        <option value="Campus Life">Campus Life</option>
        <br>
        <br>
        <input type="submit" value="Edit Your Story">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
        <input type="hidden" name="story_id" value = "<?php echo $_POST['story_id'];?>" />
    </form>
    <br>
    <br>
    <form method="POST" action="userProfile.php">
    <input type="submit" value = "Go Back" />
  </form>
</body>
</html>