<?php
/* This code enables user registration functionality
@author Alexis (basic implementation), Isabel (improvements + complex additions of user data)
Last modified 12/16/2020 */
?>


<?php
$path = '../../Private/users.json';

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
	// compile new user profile
	$regTime = time();
	$userInfo = [
		"psw" => $newPsw,
		"registered" => $regTime, // current unix timestamp
		"admin" => false, // regular user to begin with
		"pfp" => null, // no profile pic to begin with
		"about" => "This user hasn't added a bio.", // no bio to begin with
		"patterns" => [] // no patterns to begin with
	];
	// add it to the php array under the new username
	$phpArray[$newUser] = $userInfo;
	$updatedArray = json_encode($phpArray);
	file_put_contents($path, $updatedArray);
	// make new private folders for their patterns/profile picture
	$userFolder = "../../Private/" . $newUser;
	mkdir($userFolder);
	mkdir($userFolder . "/patterns");
	// create a new array for their messages with a welcome message in it
	$messages = [
		"unread" => [["text" => "Congratulations on your new account!", "from" => "THE MANAGEMENT", "sent" => $regTime]],
		"read" => []
	];
	// save that as a new json in their folder
	file_put_contents($userFolder . "/messages.json", json_encode($messages));

	// start session
	session_start();
	$_SESSION["username"] = $newUser;
	$_SESSION["admin"] = false;

	echo "Success";
}
?>