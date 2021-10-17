<?php
    require "database.php";
    session_start();
    if(!isset($_SESSION["username"])){
        echo("You must be logged in to comment.");
        header('refresh:2 url=login.html');
        exit;
    }
    //checking token validity, will be passed when user selected "add comment" on displayPostedStories.php
    if(!hash_equals($_SESSION['token'], $_POST['token'])){
        die("Request forgery detected");
    }
    $story_id = $_POST["story_id"];
    //need a comment id 
    //comment id would be helpful when wanting to edit or delete a comment
    $comment = (string)$_POST["comment"];
    $username = (string)$_SESSION["username"];

    $stmt = $mysqli->prepare("INSERT INTO comments (Comment, Story_Id, Username) values (?, ?, ?)");
    if(!$stmt){
	    printf("Query Prep Failed: %s\n", $mysqli->error);
	    exit;
    }

    $stmt->bind_param('sis', $comment, $story_id, $username);

    $stmt->execute();

    $stmt->close();

    echo("Comment added!");
    header('refresh:2 url=displayPostedStories.php');
    exit;

?>