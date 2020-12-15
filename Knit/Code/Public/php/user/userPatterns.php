<?php
  // This file generates the "Patterns" page (included in the user account tab)
  // @author Isabel
  // Last modified 12/7/2020

  // getting the patterns' data
  $patterns = $userData["patterns"];
?>
<img src="imgs/quizzes/backbutton.jpg" alt="back button" class="backBtnImg" onclick="hide('userPatterns'); show('userHome')"><br><br>

<div id="userPatternsContent">
	<h4>Patterns</h4>
	<?php if (count($patterns) == 0): ?>
	  <p>You don't have any saved patterns yet. Go to the "Pattern Maker" tab to add some!</p>
	<?php else: ?>
	  <span  id = 'uPaDiv'><p class='alert alert-info' role='alert'>Here are your saved patterns. Click on a pattern to view more options (download, edit privacy level).</p></span>
	<div class="row justify-content-center" id = "userPatternList">
	  <?php foreach($patterns as $index => $pattern): 
	    $imgFile = $pattern["image"];
	    if ($pattern["public"]) {
	      $pubPr = "Public";
	    } else {
	      $pubPr = "Private";
	    }
	  ?>
	    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<a onclick = "show('managePattern<?= $index; ?>')"><img class='uPa' src="<?= $userFolder . "patterns/" . $imgFile; ?>" alt = "Pattern by you"></a>
			</div>
	    <div class = 'dark' id = 'managePattern<?= $index; ?>'>
			<div class="floatDiv">
	      <div class = "float">
	        <button id = 'close' onclick = 'hide("managePattern<?= $index; ?>")'><i class="fa fa-times"></i></button><br>
					<p><span class = "tag" id = "tag<?= $index; ?>" onclick = "togglePubPr(this, <?= $index; ?>)"><?= $pubPr; ?></span></p>
					<!-- this tag is hidden and is just for canceling purposes -->
					<span id = "prevTag<?= $index; ?>" class = "hide"><?= $pubPr; ?></span>
	        <img class = "uPaM" src = '<?= $userFolder . "patterns/" . $imgFile; ?>'><br>
					<a href = '<?= $userFolder . "patterns/" . $imgFile; ?>' download><button class="btn1 download">Download</button></a>
					<button class="btn1 download" onclick = "showPatDelete('<?= $username; ?>', <?= $index; ?>)">Delete</button>
					<span class = "patternEdit" id = "patternEdit<?= $index; ?>">
						<button class="btn1" onclick = "savePatEdit('<?= $username; ?>', <?= $index; ?>);">Save</button>
						<button class="btn1" onclick = "cancelPatEdit(<?= $index; ?>)">Cancel</button>
					</span>
					<!-- updates pertaining to this specific pattern -->
					<span id = "uPaDiv<?= $index; ?>"></span>
	      </div>
	  </div>
	    </div>
	  <?php endforeach; ?>
  </div>
	<?php endif; ?>
</div>

<!-- confirmation div to delete a pattern -->
<div id = "deletePattern" class = "dark">
	<div class = "float">
		<p>Are you sure you want to delete this pattern? This action cannot be undone.<p>
		<a href = "#userPatterns"><button id = "deletePatBtn" class = "btn1">Yes, delete pattern</button></a>
		<button class = "btn1" onclick = "hide('deletePattern')">No, cancel</button>
	</div>
</div>