<?php
  // This file formats a user's profile given their username
  // (for loading into forum, contest tabs when a username is clicked on)
  // @author Isabel
  // Last modified 11/3/2020

  //Get all user data
  $usersData = json_decode(file_get_contents("../../../Private/users.json"), true);
  
  //Where is this being loaded?
  $to = $_GET["to"];
  //Where is this being requested from?
  $from = $_GET['from'];
  //What div should we go to when we close?
  $fromLink = $_GET['fromLink'];

  //Get the proper user's info
  $username = $_GET['uname'];
  $userData = $usersData[$username];
  $userFolder = "../Private/" . $username . "/";
  if($userData["pfp"]) {
    $pfp = $userFolder . $userData["pfp"];
  } else {
    $pfp = "imgs/defaultPfp.png";
  }
  $about = $userData["about"];
  $patterns = $userData["patterns"];
  // figuring out which patterns to display
  $pubPatterns = "";
  foreach($patterns as $pattern) {
    if ($pattern["public"]) { // if it's public,
      $imgPath = $userFolder . $pattern["image"]; // get the path to it
      $pubPatterns .= "<img class='uPa' src='$imgPath'>"; // add an element for it
    }
  }
?>

<a class="btn1" href ="#<?= $fromLink; ?>" onclick="hide('<?= $to; ?>'); show('<?= $from; ?>')"><i class="fas fa-arrow-left"></i> Back</a><br><br>

<div class="profile">
  <img class="pfp" src= '<?= $pfp; ?>' alt='<?= $username; ?>-s profile picture'>
  <h4><?=$username; ?></h4>
  <?php if ($userData["admin"]): ?>
    <p><i class="far fa-star"></i></i> ADMIN <i class="far fa-star"></i></p>
  <?php endif; ?>
  <h5>About me</h5>
  <p class="about"><?= nl2br($about); ?></p>
  <h5>My patterns</h5>
  <p>(created in the "Pattern Maker" tab)</p>
  <?php if ($pubPatterns != ""): // if there are actually public patterns to display?>
    <?= $pubPatterns; ?>
  <?php else: ?>
    <p>This user doesn't have any public patterns.</p>
  <?php endif;?>
</div>