<?php
  //This file formats a user's profile for editing

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

<button class="btn1" onclick="hide('profileEdit'); show('userHome')"><i class="fas fa-arrow-left"></i> Back</button> <button class="btn1" onclick="editProfile()">Edit profile</button><br><br>

<p>This is what other users see when they click on your username in the forum and/or contest pages.</p>

<div id="mainProfile">
  <img class="pfp" src= '<?= $pfp; ?>' alt='<?= $username; ?>-s profile picture'>
  <h4><?=$username; ?></h4>
  <?php if ($userData["admin"]): ?>
    <p><i class="far fa-star"></i></i> ADMIN <i class="far fa-star"></i></p>
  <?php endif; ?>
  <h5>About me</h5>
  <p class="about"><?= $about; ?></p>
</div>