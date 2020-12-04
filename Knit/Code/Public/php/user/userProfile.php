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
  <div id = "viewPfp">
    <img id = "viewPfpImg" src= '<?= $pfp; ?>' alt='<?= $username; ?>-s profile picture'>
    <div id = "editPfpBtn">
      <button class = "btn1" onclick = "show('editPfp')"><i class="fas fa-pencil-alt"></i></button>
    </div>
  </div>
  <h4><?=$username; ?></h4>
  <?php if ($userData["admin"]): ?>
    <p><i class="far fa-star"></i></i> ADMIN <i class="far fa-star"></i></p>
  <?php endif; ?>
  <h5>About me <button class = "btn1" onclick = "show('editAbout')"><i class="fas fa-pencil-alt"></i></button></h5>
  <p class = "about" id = "abtStatic"><?= nl2br($about); ?></p>
  <h5>My patterns <button class = "btn1" onclick = "show('editPatterns')"><i class="fas fa-pencil-alt"></i></button></h5>
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
  <form class = "float">
    <textarea id = "abtEdit"><?= $about; ?></textarea><br><br>
    <button type = "button" class="btn1" onclick="editProfile('<?= $username; ?>', 'about');">Save</button>
    <button type = "button" class="btn1" onclick="cancelUPEdit('editAbout')">Cancel</button>
  </form>
</div>

<div class = "dark" id = "editPfp">
  <div class = "float">
    <form id = "pfpForm" enctype="multipart/form-data">
      <input type = "file" id = "pfpFile">
      <input type = "hidden" id = "pfpUname" value = "<?= $username; ?>"><br><br>
      <button type = "button" class="btn1" onclick="editProfile('<?= $username; ?>', 'pfp');">Save</button>
      <button type = "button" class="btn1" onclick="cancelUPEdit('editPfp')">Cancel</button>
    </form>
    <span id = "pfpFeedback"></span>
  </div>
</div>

<div class = "dark" id = "editPatterns">
  <div class ="float">
    <p>Return to the account menu and go to "My Patterns" to manage your saved patterns, including their visibilty.</p>
    <button class = "btn1" onclick = "hide('editPatterns')">Got it</button>
  </div>
</div>