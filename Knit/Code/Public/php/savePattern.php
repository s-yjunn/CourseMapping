<?php
  // This script converts base64 encoded canvas data into an image in a user's account
  // @author Isabel, processing code adapted from http://j-query.blogspot.com/2011/02/save-base64-encoded-canvas-image-to-png.html
  // Last modified 12/14/2020

  // get the data from the JS call
  $username = $_POST["uname"];
  $canvasData = $_POST["canvas"];

  $time = time(); // so the file name is unique
  $destination = "../../Private/$username/patterns/$time.png"; // where we want to save this

  // processing the canvas data
	$canvasData = str_replace('data:image/png;base64,', '', $canvasData);
	$canvasData = str_replace(' ', '+', $canvasData);
  $data = base64_decode($canvasData);
  
  // try to add it to the folder, and if all goes well,
	if (file_put_contents($destination, $data)) {
    // get the users data from the server
    $usersData = json_decode(file_get_contents("../../Private/users.json"), true);
    // create a new pattern entry
    $pattern = [
      "image" => $time . ".png",
      "public" => false, // default to private
    ];
    // add it to the user's patterns
    array_unshift($usersData[$username]["patterns"], $pattern);

    // try to update the json file
    if (file_put_contents("../../Private/users.json", json_encode($usersData))) {
      echo 1; // indicate success to jQuery script
    } else {
      echo 0; // indicate failure
    }
  } else {
    echo 0; // indicate failure
  }
?>