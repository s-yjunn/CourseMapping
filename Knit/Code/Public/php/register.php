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

// set a boolean for if user can register or not
$register = true;

if (trim($newUser) == "") { // check for empty user
	$register = false;
	echo "<p>Please enter a username.</p>";
} else if (trim($newPsw) == "") { // check for empty psw
	$register = false;
	echo "<p>Please enter a password.</p>";
} else if ($newPsw !== $confPsw) { // check if passwords match
	$register = false;
	echo "<p>Passwords don't match.</p>";
}

// if array empty, i.e. no users exist
if (count($phpArray) == 0) {
	// if passed all other tests
	if ($register != false) {
		echo "<p>Registration successful.</p>";
		// set credentials to first item of array
		$phpArray[0]->uname = $newUser;
		$phpArray[0]->psw = $newPsw;
		// encode array back to json string
		$updatedArray = json_encode($phpArray);
		// put json string back into users.json
		file_put_contents($path, $updatedArray);
	}
} 
// if array not empty
else {
	// loop over array of existing users
	foreach ($phpArray as $key => $value) {
		$oldUser = $value["uname"]; // exisiting user
		if ($newUser == $oldUser) { // username already exists
			$register = false;
			echo "<p>Username already taken.</p>";
			break;
		}
	}
	// if passed all other tests
	if ($register != false) {
		echo "<p>Registration successful.</p>";
		// add user credentials to php array
		array_push($phpArray, (array)[
		        'uname' => $newUser,
		        'psw' => $newPsw]);
		// overwrite json file with new array
		$updatedArray = json_encode($phpArray);
		file_put_contents($path, $updatedArray);
	}
}
?>