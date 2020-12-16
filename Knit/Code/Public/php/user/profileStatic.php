<?php
  // This file formats a user's profile given their username
  // (for loading into forum, contest tabs when a username is clicked on)
  // @author Isabel + styling by Alexis
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
      $imgPath = $userFolder . "/patterns/" . $pattern["image"]; // get the path to it
      $pubPatterns .= "<div class='col-xs-12 col-sm-6 col-md-4 col-lg-3'><img class='uPa' src='$imgPath'></div>"; // add an element for it
    }
  }
?>

<a href ="#<?= $fromLink; ?>" onclick="hide('<?= $to; ?>'); show('<?= $from; ?>')"><img src="imgs/quizzes/backbutton.jpg" alt="back button" class="backBtnImg"></a><br><br>

<div class="profile">
    <div class="introSection">
		<div id="containerPfp">
			<img class="pfp" src= '<?= $pfp; ?>' alt='<?= $username; ?>-s profile picture'>
		</div>
		<h4><?=$username; ?></h4>
		<?php if ($userData["admin"]): ?>
			<p class="tagAdmin"><i class="far fa-star fa-sm"></i> Admin <i class="far fa-star fa-sm"></i></p>
		<?php endif; ?>
	</div>
	<div class="section">
		<h4>About Me</h4>
		<p class="about"><?= nl2br($about); ?></p>
	</div>
	<div class="section">
		<h4>My Patterns</h4>
		<!--<p>(created in the "Pattern Maker" tab)</p>-->
		<?php if ($pubPatterns != ""): // if there are actually public patterns to display?>
		<div class="row"><?= $pubPatterns; ?></div>
		<?php else: ?>
		<p>This user doesn't have any public patterns.</p>
		<?php endif;?>
	</div>
</div>