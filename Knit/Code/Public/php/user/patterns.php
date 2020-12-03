<?php
  // This file (imported into the user page) allows a user to see their saved patterns.
  // @author Isabel
  // Last modified 12/2/2020

  // getting the patterns' data
  $patterns = $userData["patterns"];
  // path to image files
  $userFolder = "../Private/imgs/" . $username . "/"
?>
<button class="btn1" onclick="hide('userPatterns'); show('userHome')"><i class="fas fa-arrow-left"></i> Back</button><br><br>
<div id="userPatternsContent">
	<h4>My Patterns</h4>
	<?php if (count($patterns) == 0): ?>
	  <p>You don't have any saved patterns yet. Go to the "Pattern Maker" tab to add some!</p>
	<?php else: ?>
	  <p id = 'uPaDiv'>Here are your saved patterns. Click on a pattern to see more options (download, view privacy level).</p>
	<div class="row justify-content-center">
	  <?php foreach($patterns as $index => $pattern): 
	    $imgFile = $pattern["image"];
	    if ($pattern["public"]) {
	      $pubPr = "Public";
	    } else {
	      $pubPr = "Private";
	    }
	  ?>
	    <div class="col-xs-12 col-md-4">
		<a onclick = "show('managePattern<?= $index; ?>')"><img class='uPa' src="<?= $userFolder . $imgFile; ?>" alt = "Pattern by you"></a></div>
	    <div class = 'dark' id = 'managePattern<?= $index; ?>'>
	      <div class = "float">
	        <button id = 'close' onclick = 'hide("managePattern<?= $index; ?>")'><i class="fa fa-times"></i></button><br>
	        <h5> <?= $imgFile; ?></h5>
	        <p><span class="tag"><?= $pubPr; ?></span></p>
	        <img class = "uPaM" src = '<?= $userFolder . $imgFile; ?>' max-width = 100%><br>
	        <a href = '<?= $userFolder . $imgFile; ?>' download><button class="btn1">Download</button></a>
	      </div>
	    </div>
	  <?php endforeach; ?>
  </div>
	<?php endif; ?>
</div>