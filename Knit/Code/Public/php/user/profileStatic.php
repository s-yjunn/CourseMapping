<?php
  //This file formats a user's profile given their username

  //Get all user data
  $usersData = json_decode(file_get_contents("../../../Private/data/users.json"), true);
  
  //Where is this being loaded?
  $to = $_GET["to"];
  //Where is this being requested from?
  $from = $_GET['from'];
  //What div should we go to when we close?
  $fromLink = $_GET['fromLink'];

  //Get the proper user's info
  $username = $_GET['uname'];
  $userData = $usersData[$username];
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

<a class="btn1" href ="#<?= $fromLink; ?>" onclick="hide('<?= $to; ?>'); show('<?= $from; ?>')"><i class="fas fa-arrow-left"></i> Back</a><br><br>

<div id="mainProfile">
  <img class="pfp" src= '<?= $pfp; ?>' alt='<?= $username; ?>-s profile picture'>
  <h4><?=$username; ?></h4>
  <?php if ($userData["admin"]): ?>
    <p><i class="far fa-star"></i></i> ADMIN <i class="far fa-star"></i></p>
  <?php endif; ?>
  <h5>About me</h5>
  <p class="about"><?= $about; ?></p>
</div>