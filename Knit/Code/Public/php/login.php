<?php
$path = '../../Private/data/users.json';

// read json file
$jsonArray = file_get_contents($path);
// convert json string to php array
$phpArray = json_decode($jsonArray, true);

// get user input from login.html
$attemptUser = $_GET['loginUname'];
$attemptPsw = $_GET['loginPsw'];

if (trim($attemptUser) == "") { // check for empty user
	echo "<p class='alert alert-danger' role='alert'>Please enter a username.</p>";
} else if (trim($attemptPsw) == "") { // check for empty psw
	echo "<p class='alert alert-danger' role='alert'>Please enter a password.</p>";
} else if (!array_key_exists($attemptUser, $phpArray)) { //check for nonexistent user
	echo "<p class='alert alert-danger' role='alert'>User does not exist.</p>";
} else if ($attemptPsw != $phpArray[$attemptUser]["psw"]) { // check for wrong password
	echo "<p class='alert alert-danger' role='alert'>Incorrect password.</p>";
// If all is well,	
} else {
	// save username and admin boolean to the session
	session_start();
	$_SESSION["username"] = $attemptUser;
	if ($phpArray[$attemptUser]["admin"] == true) {
		$_SESSION["admin"] = true; // is admin
		echo "Success-admin";
	} else {
		$_SESSION["admin"] = false; // is not admin
		echo "Success";
	}
}
?>
