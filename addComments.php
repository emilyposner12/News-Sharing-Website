<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel = "stylesheet" href = "style.css">
    <title>Add Comment</title>
  </head>
  <body>
    <h1> Add Your Own Comment</h1>
    <form action="addCommentsProcess.php" method="post">
        <textarea name="comment" id="comments" style="font-family:sans-serif;font-size:1.2em;">What do you think?</textarea>
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
        <input type = "hidden" name = "story_id" value="<?php echo $_GET['story_id']; ?>" />
        <input type="submit" value="Submit">
    </form>
    <form action="displayPostedStories.php" method="POST">
    <input type="submit" value = "Return Home" />
  </form>
  </body>
</html>