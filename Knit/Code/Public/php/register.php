<?php
$path = '../../Private/data/users.json';

// read in json file as json string
$jsonArray = file_get_contents($path);
// convert json string to php array
$phpArray = json_decode($jsonArray, true);

// get user input info from register page
$newUser = $_GET['regUname'];
$newPsw = $_GET['regPsw'];
$confPsw = $_GET['confPsw'];


if (trim($newUser) == "") { // check for empty user
	echo "<p class='alert alert-danger' role='alert'>Please enter a username.</p>";
} else if (trim($newPsw) == "") { // check for empty psw
	echo "<p class='alert alert-danger' role='alert'>Please enter a password.</p>";
} else if (array_key_exists($newUser, $phpArray)) { // check if username is in use
	echo "<p class='alert alert-danger' role='alert'>Username already taken.</p>";
} else if ($newPsw !== $confPsw) { // check if passwords match
	echo "<p class='alert alert-danger' role='alert'>Passwords don't match.</p>";
// if passed all tests
} else {
	// add user credentials to php array
	$phpArray[$newUser]["psw"] = $newPsw;
	$phpArray[$newUser]["admin"] = false; // can't be admin to begin with
	// overwrite json file with new array
	$updatedArray = json_encode($phpArray);
	file_put_contents($path, $updatedArray);

	// start session
	session_start();
	$_SESSION["username"] = $newUser;
	$_SESSION["admin"] = false;

	echo "Success";
}
?>