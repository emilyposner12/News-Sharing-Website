<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel = "stylesheet" href = "style.css">
    <title>Edit Comment</title>
  </head>
  <body>
      <h1> Edit Comment</h1>
      <?php

    session_start();
    require 'database.php';

$comment_id = (int)$_POST['comment_id'];
$comment = (string)$_POST['comment'];
?>

<form action ="editCommentCheck.php" method="POST">
        <label> New Comment: </label>
        <input type="text" name="comment" required>
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
        <input type="hidden" name="comment_id" value = "<?php echo $_POST['comment_id'];?>" />
        <input type="submit" name ="editComment"/>
</form>
<form method="POST" action="userProfile.php">
    <input type="submit" value = "Go Back" />
</form>

</body> 
</html>