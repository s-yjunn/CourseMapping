<?php 
  // This script handles various modifications to a user's public profile
  // @author Isabel
  // Last modified 12/4/2020

  // store the user in question
  $username = $_POST["uname"];
  error_log($username);
  // get the users data from the server
  $usersData = json_decode(file_get_contents("../../../Private/users.json"), true);

  //if the 'about' field is being changed
  if (isset($_POST["about"])){
    if ($_POST["about"] == "") {
      $usersData[$username]["about"] = "This user hasn't added a bio.";
    } else {
      $usersData[$username]["about"] = $_POST["about"];
    }

  // if instead the profile is being changed (it's never both)
  } else if (isset($_FILES["pfp"])) {
    error_log("Yes");
  } else {
    error_log("No");
  }

  // finally, push the updated info back to the server
  file_put_contents("../../../Private/users.json", json_encode($usersData));
?>