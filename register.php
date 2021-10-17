<?php
require "database.php";

$username = (string)$_POST["username"];
$password = (string)$_POST["password"];

$checkIfUsernameExists = $mysqli->prepare("SELECT username FROM users WHERE username=?");
if(!$checkIfUsernameExists){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}

$checkIfUsernameExists->bind_param('s', $username);
$username = $_POST['username'];
$checkIfUsernameExists->execute();

$checkIfUsernameExists->bind_result($user);
$checkIfUsernameExists->fetch();
$checkIfUsernameExists -> close();

//compare results of query with new username to ensure it hasn't aready been taken
if(strcmp($username, $user) == 0){ //if query result and selected username are the same
	echo "This username has already been taken. Please try another username.";
	header('refresh:2 url=registrationPage.html');
	exit;
} 


//otherwise hash entered password and store it with username
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$insert_new_user = $mysqli->prepare("INSERT INTO users (username, password_hash) VALUE (?,?)");
if(!$insert_new_user){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
//store hashed password and username
$insert_new_user->bind_param('ss', $username, $hashed_password);
$insert_new_user->execute();
$insert_new_user->close();
echo("Account created.");
header('refresh:2 url=login.html');
exit;
?>