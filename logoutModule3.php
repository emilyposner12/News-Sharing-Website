<?php
    session_start();
    session_destroy();
    echo("User logged out.");
    header("Location: displayPostedStories.php");
    exit;
?>