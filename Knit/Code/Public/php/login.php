<?php
$path = '../../Private/data/users.json';

// read in json file
$jsonArray = file_get_contents($path);
// convert json string to php array
$phpArray = json_decode($jsonArray, true);

// get user input from login.html
$attemptUser = $_GET['loginUname'];
$attemptPsw = $_GET['loginPsw'];

// user will login only if correct credentials
$login = false;

// loop over existing users
foreach ($phpArray as $key => $value) {
	// username of current user in existing users array
	$existingUser = $value["uname"];
	$existingPsw = $value["psw"];
	// compare entered username to existing username
	if ($attemptUser == $existingUser) { 
		// username is correct
		// now check if password is correct
		if ($attemptPsw == $existingPsw) { // password is correct
			$login = true;
			break;
		}
	}
}

if ($login == true) { // user entered correct credentials
	//$_SESSION["username"] = $attemptUser;
	echo "<p>Log in successful.</p>";
} else { // user entered incorrect credentials
	echo "<p>Incorrect username or password.</p>";
}
?>
