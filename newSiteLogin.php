<?php
require 'database.php';
session_start();

// Use a prepared statement
$stmt = $mysqli->prepare("SELECT password_hash FROM users WHERE username=?");

// Bind the parameter
$stmt->bind_param('s', $user);
$user = (string)$_POST['username'];
$stmt->execute();

// Bind the results
$stmt->bind_result($pwd_hash);
$stmt->fetch();

$pwd_guess = (string)$_POST['password'];
// Compare the submitted password to the actual password hash

if(password_verify($pwd_guess, $pwd_hash)){
	// Login succeeded!
	$_SESSION['username'] = $user;
    $_SESSION['token'] = bin2hex(random_bytes(32));
	$_SESSION['isUser'] = true;
	echo("Login success.");
	echo("Username: ". $_SESSION['username']);
    header('refresh:2 url=displayPostedStories.php');
} else{
	echo("Username/Password combination does not match. Please try again.");
    header('refresh:2 url=login.html');
}
?>