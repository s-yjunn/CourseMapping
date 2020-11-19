<?php

// function getVotes($contestantData){
// 	// STUB
// 	$votes = array(2,3);
// 	return $votes;
// }

	//moved & modified by Isabel -- array of entries accepted for voting is now the value of "contestants" 	in the json contest file
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
	
	<div class="submit">
		<h4>Submit</h4>
		<p>Submit your unique knitting patterns to enter our weekly contest! Winners are determined by user voting and have a chance to be featured on our weekly slideshow. To submit, please upload <b>one text file</b> of pattern-making instructions, <b>one image</b> of a knit creation made via your instructions, and a <b>title</b> for your creation.</p>
		<form action="php/upload.php" method="post" enctype="multipart/form-data" id="submit">
		  <input type="file" name="fileToUpload[]" id="fileToUpload" multiple="multiple">
		  <input type="submit" value="Upload File" name="submit">
		</form>
	</div>
	
	<?php if($numCont == 0): ?>
	  <p>There are currently no contest entries! Please come back later for updates.</p>    
	<?php  else: ?>
	  <div class="container">
	  	<div class="row">
		  <?php for($i = 0; $i < $numCont; $i++):
			  // echo "i=".$i."<br>";
			  $user = $contestantData[$i]["author"];
			  $image = "contest/" . $contestantData[$i]["image"];
			  $description = $contestantData[$i]["text"];
			  $numVotes = $contestantData[$i]["votes"];
			  $GLOBALS['user'] = $user;
			  ?>
			<div class="col-xl-3 col-md-6 col-xs-12">
				<div class="card">
					<div class='card-body'>
						<img class='card-img-top' src='<?= $image ?>' alt='Knit submission by <?= $user ?>'>
						<div class='card-title'>
							<h5>Title</h5>
							<h6><?= $user ?></h6>
						</div>
						<!--<p class='card-text'><?= $description ?></p>-->
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
	<?php endif;// if(!isset($_SESSION)) {}?>

</div>

<script type="text/javascript">

function updateVote(i, vote){
	alert(i);
	alert(vote);
	
	document.getElementById("numVotes").innerHTML = vote + 1;

	// contestantData[i]= vote + 1;

	$("#hide").click(function(){
		$("#hide").hide();
	});

      document.getElementById("demo").innerHTML = "Thanks for voting!";

}

</script>