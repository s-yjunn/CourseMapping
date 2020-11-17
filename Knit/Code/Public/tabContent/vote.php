<div id="Vote" class="tabcontent">
<div class="card">
	  <h3>Vote for your favorite design, <a href="#submit">or submit your own</a>!</h3>
    <?php

//moved & modified by Isabel -- array of entries accepted for voting is now the value of "contestants" in the json contest file
$comp = file_get_contents("data/contest.json");
$compData = json_decode($comp, true);
$currentData = $compData["contestants"];
$numCont = count($currentData);

if($numCont == 0){
    echo '<p>There are currently no contest entries! Please come back later for updates.</p>';    
    }
    else{
      echo '<br>',
      '<table style="width:100%">',
        '<tr>',
          '<th>User</th> ',
          '<th>Design</th> ',
          '<th>Instructions</th>',
          '<th>Votes</th>',
          '<th>Vote Here!</th>',
        '</tr>';

        for($i = 0; $i < count($currentData); $i++){
          $user = $currentData[$i]["author"];
          $image = "<img width=50% src=contest/" . $currentData[$i]["image"] . ">";
          $description = $currentData[$i]["text"];
          $numVotes = $currentData[$i]["votes"];
          $GLOBALS['user'] = $user;
      
          echo'<tr>',
          '<td>'.$user.'</td>',
          '<td>'.$image.'</td>',
          '<td>'.$description.'</td>',
          '<td>'.$numVotes.'</td>',
          '<td><form><input id="hide" type="button" value="Vote" onclick="updateVote('.$i.')"></form><p id="demo"></p></td>',
          '</tr>';
  }
  
  echo '</table>';

}
?>
<br><br><br><br>
<?php 

#if(!isset($_SESSION)) {
  
  echo '<form action="php/upload.php" method="post" enctype="multipart/form-data" id="submit">',
  'Select your files. Please upload one text file and one image: <br>',
  '<input  type="file" name="fileToUpload[]" id="fileToUpload" multiple="multiple" />',
  '<input type="submit" value="Upload File" name="submit">',
'</form>';
  
#}

#else {

#  echo "Only members can submit designs! Log in or sign up to become a member!";

#}

?>

</div>
</div>

<script type="text/javascript">

function updateVote(i){

var compData = JSON.parse("data/contest.json");

var currentData = compData.contestants;

    currentData[i].votes += 1;

    $("#hide").click(function(){
        $("#hide").hide();
      });

      document.getElementById("demo").innerHTML = "Thanks for voting!";

}

</script>