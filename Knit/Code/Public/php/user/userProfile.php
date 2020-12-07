<?php
  // This file generates the "My Profile" page within the account tab
  // @author Isabel
  // Last modified 11/2/2020

  $userData = $usersData[$username];

  //Get the proper user info
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
      $pubPatterns .= "<div class='col-xs-12 col-sm-6 col-md-4 col-lg-3'><img class='uPa' src='$imgPath'></div>"; // add an element for it
    }
  }
?>

<button class="btn1" onclick="hide('userProfile'); show('userHome')"><i class="fas fa-arrow-left"></i> Back</button>

<div class = "profile">
    <div class="introSection">
      <h4>My Profile</h4>
      <p id = 'uPrDiv' class='alert alert-info' role='alert'>This is what other users see when they click on your username in the forum and/or contest pages.</p>
		  <div id="containerPfp">
		    <div id = "viewPfp">
				<img id = "viewPfpImg" src= '<?= $pfp; ?>' alt='<?= $username; ?>-s profile picture'>
				<div id = "editPfpBtn" onclick = "show('editPfp')">
				  <button class = "btnPfp"><i class="fas fa-pencil-alt fa-3x"></i></button>
				</div>
			</div>
		</div>
		<div id="containerUsername">
			<h4><?=$username; ?></h4>
			<?php if ($userData["admin"]): ?>
			<p class="tagAdmin"><i class="far fa-star fa-sm"></i> Admin <i class="far fa-star fa-sm"></i></p>
			<?php endif; ?>
		</div>
	</div>
	<div class="section">
	  <h4>About Me <button class = "btn1 btnEdit float-right" onclick = "show('editAbout')"><i class="fas fa-pencil-alt fa-xs"></i></button></h4> 
	  <p class = "about" id = "abtStatic"><?= nl2br($about); ?></p>
	</div>
	<div class="section">
	  <h4>My Patterns <button class = "btn1 btnEdit float-right" onclick = "show('editPatterns')"><i class="fas fa-pencil-alt fa-xs"></i></button></h4>
	  <!--<p>(created in the "Pattern Maker" tab)</p>-->
	  <?php if ($pubPatterns != ""): // if there are actually public patterns to display?>
	    <div class="row"><?= $pubPatterns; ?></div>
	  <?php else: ?>
	    <p>This user doesn't have any public patterns.</p>
	  <?php endif;?>
	</div>
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
      <input type = "file" id = "pfpFile"><br><br>
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