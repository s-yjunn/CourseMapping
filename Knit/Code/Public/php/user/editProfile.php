<?php 
  // This script handles various modifications to a user's public profile
  // @author Isabel
  // Last modified 12/4/2020

  //var_dump($_POST["pfp"]);
  // store the user in question
  $username = $_POST["uname"];
  error_log(implode("+", $_FILES));
  // get the users data from the server
  $usersData = json_decode(file_get_contents("../../../Private/users.json"), true);

  //if this is being requested from the 'editBio' js function
  if (isset($_POST["about"])){
    if ($_POST["about"] == "") {
      $usersData[$username]["about"] = "This user hasn't added a bio.";
    } else {
      $usersData[$username]["about"] = $_POST["about"];
    }
  }

  // if instead the profile is being changed
  if (isset($_FILES["pfp"])) {
    // Need to add some validation in here still
    //$usersData[$username]["pfp"] = true;
  }

  // finally, push the updated info back to the server
  file_put_contents("../../../Private/users.json", json_encode($usersData));
?>