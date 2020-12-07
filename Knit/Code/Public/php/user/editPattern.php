<?php
  /* This script updates the "public" field in a user's data entry
  * called on by the savePattern function in user.js
  * @author Isabel
  * Last modified 12/4/2020
  */

  // store the user in question
  $username = $_POST["uname"];
  // and the pattern index in question
  $index = intval($_POST["index"]);
  $newPubPr = $_POST['new']; // this is a string

  // get the users data from the server
  $usersData = json_decode(file_get_contents("../../../Private/users.json"), true);

  //save old "public" attribute (in case of error)
  $oldVal = $usersData[$username]["patterns"][$index]["public"];
  if ($oldVal) {
    $oldPubPr = "Public";
  } else {
    $oldPubPr = "Private";
  }

  // figure out what the associated boolean for the new attribute "public" is
  if ($newPubPr == "Public") {
    $newVal = true;
  } else if ($newPubPr == "Private") {
    $newVal = false;
  } else {
    echo $oldPubPr; // failure to jQuery script
    exit;
  }

  // and set the value of the pattern's publicity to the new value
  $usersData[$username]["patterns"][$index]["public"] = $newVal;

  // try to update the json file
  if (file_put_contents("../../../Private/users.json", json_encode($usersData))) {
    echo 1; // success to jQuery script
  } else {
    echo $oldpubPr;
  }
?>