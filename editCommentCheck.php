<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Edit Comment</title>
</head>
<body>
<h2>Edit Comment</h2>
<?php
session_start();

require 'database.php';

//CSRF token validation
if(!hash_equals($_SESSION['token'], $_POST['token'])){
	session_destroy();
	die("Request forgery detected, please login again");
}

//get details to update
$comment_id = (int)$_POST['comment_id'];
$comment = (string)$_POST['comment'];


if($comment == ""){
	echo "<p> Edit unsuccessful. Make sure to fill out required field. </p>";
}
else{
    $stmt = $mysqli->prepare("UPDATE comments SET comment = ? WHERE Unq_Comment_Id = ?");
	$stmt = $mysqli->prepare("UPDATE comments SET comment = ? WHERE Unq_Comment_Id = ?");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}

	$stmt->bind_param('si', $comment, $comment_id);

	$stmt->execute();
	$stmt->close();
	echo "<p> Congrats! You sucessfully edited your comment. </p>";
}

    header("Refresh:2; url=userProfile.php");
?>

<!-- <form action ="displayPostedStories.php" method="POST">
    <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" />
    <input type="submit" value="return" />
</form> --> 

</body> 
</html>
