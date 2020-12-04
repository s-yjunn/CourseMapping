<?php
  // This file generates the "My Profile" page within the account tab
  // @author Isabel
  // Last modified 11/2/2020

  $userData = $usersData[$username];

  //Get the proper user info
  if($userData["pfp"]) {
      $pfp = "imgs/defaultPfp.png"; // should later be replaced with path to uploaded pfp
  } else {
      $pfp = "imgs/defaultPfp.png";
  }
  $about = $userData["about"];
  $patterns = $userData["patterns"];
?>

<button class="btn1" onclick="hide('userProfile'); show('userHome')"><i class="fas fa-arrow-left"></i> Back</button><br><br>

<div class = "profile">
  <p id = 'uPrDiv'>This is what other users see when they click on your username in the forum and/or contest pages.</p>

  <img class="pfp" id = "pfpEditImg" src= '<?= $pfp; ?>' alt='<?= $username; ?>-s profile picture'>
  <button class = "btn1" id = "editPfpBtn" onclick = "show('editPfp')"><i class="fas fa-pencil-alt"></i></button>
  <h4><?=$username; ?></h4>
  <?php if ($userData["admin"]): ?>
    <p><i class="far fa-star"></i></i> ADMIN <i class="far fa-star"></i></p>
  <?php endif; ?>
  <h5>About me <button class = "btn1" onclick = "show('editAbout')"><i class="fas fa-pencil-alt"></i></button></h5>
  <p class = "about" id = "abtStatic"><?= nl2br($about); ?></p>
  <h5>My patterns</h5>
  <p>(Created in the "Pattern Maker" tab!)</p>
  <?php foreach($patterns as $pattern): ?>
    <?php if ($pattern["public"]):
      $imgPath = "../Private/" . $username . "/" . $pattern["image"];
    ?>
      <img class='uPa' src='<?= $imgPath; ?>'>
    <?php endif; ?>
  <?php endforeach; ?>
</div>


<div class = "dark" id = "editAbout">
  <div class = "float">
    <textarea id = "abtEdit"><?= $about; ?></textarea><br><br>
    <button class="btn1" onclick="editProfile('<?= $username; ?>', 'about');">Save</button> <button class="btn1" onclick="cancelUPEdit('editAbout')">Cancel</button>
  </div>
</div>

<div class = "dark" id = "editPfp">
  <div class = "float">
    <p>Here's where you edit your pfp (under construction)</p>
    <button class="btn1" onclick="editProfile('<?= $username; ?>', 'pfp');">Save</button> <button class="btn1" onclick="cancelUPEdit('editPfp')">Cancel</button>
  </div>
</div