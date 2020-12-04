<?php 
  // This script handles various modifications to a user's public profile
  // @author Isabel

  // store the user in question
  $username = $_POST['uname'];
  // get the users data from the server
  $usersData = json_decode(file_get_contents("../../../Private/users.json"), true);

  //if this is being requested from the 'editBio' js function
  if (isset($_POST["about"])){
    // update the about field
    $usersData[$username]["about"] = $_POST["about"];
  }

  // if instead the profile is being changed
  if (isset($_POST["pfp"])) {
    // 
    $usersData[$username]["pfp"] = true;
  }

  // finally, push the updated info back to the server
  file_put_contents("../../../Private/users.json", json_encode($usersData));
?>