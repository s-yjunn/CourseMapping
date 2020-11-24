<?php
  //This file allows a user to view and edit their profile

  //if this is being requested from the 'saveProfile' js function
  if (isset($_GET["uname"])) {
    // get the current info
    $username = $_GET["uname"];
    $usersData = json_decode(file_get_contents("../../../Private/data/users.json"), true);

    if (isset($_GET["about"])){
      $usersData[$username]["about"] = $_GET["about"];
    }

    file_put_contents("../../../Private/data/users.json", json_encode($usersData));

    $userData = $usersData[$username];
  }

  //Get the proper user info
  if($userData["pfp"]) {
      $pfp = "imgs/defaultPfp.png"; // should later be replaced with path to uploaded pfp
  } else {
      $pfp = "imgs/defaultPfp.png";
  }
  if($userData["about"]) {
      $about = $userData["about"];
  } else {
      $about = "This user hasn't added a bio yet.";
  }

?>

<button class="btn1" onclick="hide('userProfile'); show('userHome')"><i class="fas fa-arrow-left"></i> Back</button><br><br>

<div class = "profile" id="viewProfile">
  <p id = 'upDiv'>This is what other users see when they click on your username in the forum and/or contest pages.</p>
  <button class="btn1" onclick="hide('viewProfile'); show('editProfile')">Edit</button><br><br>

  <img class="pfp" src= '<?= $pfp; ?>' alt='<?= $username; ?>-s profile picture'>
  <h4><?=$username; ?></h4>
  <?php if ($userData["admin"]): ?>
    <p><i class="far fa-star"></i></i> ADMIN <i class="far fa-star"></i></p>
  <?php endif; ?>
  <h5>About me</h5>
  <p class="about"><?= nl2br($about); ?></p>
</div>

<div class = "profile" id="editProfile">
  <p>Modify any fields you want to, then click "save changes" to publish your new profile.</p>
  <button class="btn1" onclick="saveProfile('<?= $username; ?>');">Save changes</button> <button class="btn1" onclick="cancelUPEdit()">Cancel</button><br><br>
  <img class="pfp" src= '<?= $pfp; ?>' alt='<?= $username; ?>-s profile picture'>
  <h4><?=$username; ?></h4>
  <?php if ($userData["admin"]): ?>
    <p><i class="far fa-star"></i></i> ADMIN <i class="far fa-star"></i></p>
  <?php endif; ?>
  <h5>About me</h5>
  <textarea class="about" id = "editAbout"><?= $about; ?></textarea>
</div>