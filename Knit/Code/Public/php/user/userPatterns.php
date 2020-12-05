<?php
  // This file (imported into the user page) allows a user to see and manage their saved patterns.
  // @author Isabel
  // Last modified 12/4/2020

  // getting the patterns' data
  $patterns = $userData["patterns"];
?>
<button class="btn1" onclick="hide('userPatterns'); show('userHome')"><i class="fas fa-arrow-left"></i> Back</button><br><br>
<div id="userPatternsContent">
	<h4>My Patterns</h4>
	<?php if (count($patterns) == 0): ?>
	  <p>You don't have any saved patterns yet. Go to the "Pattern Maker" tab to add some!</p>
	<?php else: ?>
	  <p id = 'uPaDiv'>Here are your saved patterns. Click on a pattern to view more options (download, edit privacy level).</p>
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
	        <p><span class = "tag" id = "tag<?= $index; ?>" onclick = "togglePubPr(this, <?= $index; ?>)"><?= $pubPr; ?></span></button></p>
	        <img class = "uPaM" src = '<?= $userFolder . $imgFile; ?>'><br>
					<a href = '<?= $userFolder . $imgFile; ?>' download><button class="btn1 download">Download</button></a>
					<span class = "patternEdit" id = "patternEdit<?= $index; ?>">
						<button class="btn1" onclick = "savePattern('<?= $username; ?>', <?= $index; ?>);">Save</button>
						<button class="btn1" onclick = "cancelPatEdit(<?= $index; ?>, '<?= $pubPr; ?>')">Cancel</button>
					</span>
	      </div>
	    </div>
	  <?php endforeach; ?>
  </div>
	<?php endif; ?>
</div>