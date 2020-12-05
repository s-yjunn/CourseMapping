<?php 
  // This script handles various modifications to a user's public profile
  // @author Isabel
  // Last modified 12/4/2020

  // store the user in question
  $username = $_POST["uname"];
  // get the users data from the server
  $usersData = json_decode(file_get_contents("../../../Private/users.json"), true);

  //if the 'about' field is being changed
  if (isset($_POST["about"])){
    if ($_POST["about"] == "") { // see if empty
      // if so, replace abt with generic bio
      $usersData[$username]["about"] = "This user hasn't added a bio.";
    } else { // if not, update with entered bio
      $usersData[$username]["about"] = $_POST["about"];
    }
    // try to update json
    if (file_put_contents("../../../Private/users.json", json_encode($usersData))) {
      echo 1; // indicate success to jQuery script
    } else {
      echo 0; // indicate failure
    }

  // if instead the profile is being changed (it's never both)
  } else if (isset($_FILES["pfp"])) {
    $userFolder = "../../../Private/" .$username . "/";
    // get file name
    $newPfp = $_FILES['pfp']['name'];
    $currentPfp = $usersData[$username]["pfp"];

    // establish upload destination
    $destination = $userFolder . $newPfp;
    // try to upload new pfp. If successful,
    if (move_uploaded_file($_FILES['pfp']['tmp_name'], $destination)) {
      // try to update pfp field in json
      $usersData[$username]["pfp"] = $newPfp;
      // if successful,
      if (file_put_contents("../../../Private/users.json", json_encode($usersData))) {
        // delete old pfp (if there is one)
        if ($currentPfp) {
          unlink($userFolder . $currentPfp);
        }
        // output a helpful success message (for use in updating display pic)
        echo "../Private/" .$username . "/" . $newPfp;
      } else {
        echo 0; // indicate failure to jQuery script
      }
    // otherwise,
    } else {
      echo 0; // indicate failure
    }
 }
?>