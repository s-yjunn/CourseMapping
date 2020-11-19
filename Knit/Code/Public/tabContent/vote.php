<?php

// function getVotes($contestantData){
// 	// STUB
// 	$votes = array(2,3);
// 	return $votes;
// }
	$comp = file_get_contents("data/contest.json");
	// echo "$comp";
	$compData = json_decode($comp, true);
	// echo "$compData<br>";
	$contestantData = $compData["contestants"];
	// echo "$contestantData[0]<br>";
	$numCont = count($contestantData);
	// echo "$numCont<br>";
	// $votes = getVotes($contestantData);
?>

<div id="Vote" class="tabcontent">
	<h3 class="underline">Contest</h3>
	<!--this is the contest "menu": submission form and all entries-->
	<div id="contestHome">
		<div class="submit">
			<h4>Enter the contest</h4>
			<p>Submit your unique knitting patterns to our weekly contest! Winners are determined by user voting and have a chance to be included in our "featured" slideshow.</p>
			<?php if ($loggedIn): ?>
				<p>Please submit <b>one text file</b> of pattern-making instructions, <b>one image</b> of a knit creation made via your instructions, and a <b>title</b> for your creation. You will be alerted if your pattern is accepted for inclusion in the contest!</p>
				<form action="php/upload.php" method="post" enctype="multipart/form-data" id="submit">
					<input type="text" name="title" id="title" placeholder="Your submission's title"><br>
					<input type="file" name="fileToUpload[]" id="fileToUpload" multiple="multiple">
					<input type="hidden" name="author" value="<?=$username; ?>">
					<input type="submit" value="Submit" name="submit">
				</form>
			<?php else: ?>
				<p class='alert alert-info' role='alert'>Only registered users can enter the contest. Please sign up or log in to access this feature!</p>
			<?php endif; ?>
		</div>
		
		<h4>Vote on this week's entries</h4>
		<?php if($numCont == 0): ?>
		<p>There are currently no contest entries! Please come back later for updates.</p>    
		<?php else: ?>
		<div class="container">
			<div class="row">
			<?php for($i = 0; $i < $numCont; $i++):
				// echo "i=".$i."<br>";
				$title = $contestantData[$i]["title"];
				$user = $contestantData[$i]["author"];
				$image = "imgs/contest/" . $contestantData[$i]["image"];
				$description = $contestantData[$i]["text"];
				$numVotes = $contestantData[$i]["votes"];
				$GLOBALS['user'] = $user;
				?>
				<div class="col-xl-3 col-md-6 col-xs-12">
					<div class="card" id = '<?= $i; ?>'>
						<div class='card-body'>
							<img class='card-img-top' src='<?= $image ?>' alt='Knit submission by <?= $user ?>'>
							<div class='card-title'>
								<h5><?= $title; ?></h5>
								<h6><?= $user ?></h6>
							</div>
							<!--<p class='card-text'></?= $description ?></p>-->
							<button type="button" onclick="openPattern(<?= $i; ?>, 'contestPattern', 'contestHome')">View</button>
							<form>
							<input id="hide" class="btn" type="button" value="Vote" onclick='updateVote(<?= $i ?>, <?= $numVotes ?>)'>
						</form>
						<p id="demo"></p>
						</div>
					</div>
				</div>
			<?php endfor; ?>  
			</div>
		</div>
		<?php endif;?>
	</div>

	<!-- This div will be filled by php/pattern.php when any pattern is called on -->
	<div id = "contestPattern"></div>
</div>

<script src="js/contest.js"></script>