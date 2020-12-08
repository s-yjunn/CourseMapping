<?php
  /* This script delete's one of a user's saved patterns
  * @author Isabel
  * Last modified 12/7/2020
  */

  // store the user in question
  $username = $_POST["uname"];
  $userFolder = "../../../Private/$username/patterns/";
  // and the pattern index in question
  $index = $_POST["index"];

  // get the users data from the server
  $usersData = json_decode(file_get_contents("../../../Private/users.json"), true);

  // save some info we need
  $pub = $usersData[$username]["patterns"][$index]["public"];
  $image = $usersData[$username]["patterns"][$index]["image"];

  // then delete the pattern
  unset($usersData[$username]["patterns"][$index]);

  // try to update the json file
  if (file_put_contents("../../../Private/users.json", json_encode($usersData))) {
    // if successful, delete the image itself
    unlink($userFolder . $image);
    if ($pub) {
      echo "Public";
    } else {
      echo "Private"; // both of the above indicate success
    }
  } else {
    echo 0; // failure
  }
?>