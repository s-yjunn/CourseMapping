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
<div class="card">
	  <h3>Vote for your favorite design, <a href="#submit">or submit your own</a>!</h3>
	  <?php if($numCont == 0): ?>
		  <p>There are currently no contest entries! Please come back later for updates.</p>    
	  <?php  else: ?>
		  <br>
		  <table style="width:100%">
			  <tr>
				  <th>User</th> 
				  <th>Design</th>
				  <th>Instructions</th>
				  <th>Votes</th>
				  <th>Vote Here!</th>
			  </tr>
	  
			  <?php for($i = 0; $i < $numCont; $i++):
				  // echo "i=".$i."<br>";
				  $user = $contestantData[$i]["author"];
				  $image = "<img width=50% src=contest/" . $contestantData[$i]["image"] . ">";
				  $description = $contestantData[$i]["text"];
				  $numVotes = $contestantData[$i]["votes"];
				  $GLOBALS['user'] = $user;
				  ?>
				  <tr>
					  <td><?= $user ?></td>
					  <td><?= $image ?></td>
					  <td><?= $description ?></td>
					  <td id="numVotes"><?= $numVotes ?></td>
					  <td>
						  <form>
							  <input id="hide" type="button" value="Vote" onclick='updateVote(<?= $i ?>, <?= $numVotes ?>)'>
						  </form>
						  <p id="demo"></p>
					  </td>
				  </tr>
			  <?php endfor; ?>
  
		  </table>

	  <?php endif;// if(!isset($_SESSION)) {}?>

	  <br><br><br><br>

	  <form action="php/upload.php" method="post" enctype="multipart/form-data" id="submit">
		  Select your files. Please upload one text file and one image: 
		  <br>
		  <input  type="file" name="fileToUpload[]" id="fileToUpload" multiple="multiple" />
		  <input type="submit" value="Upload File" name="submit">
	  </form>


</div>
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