<div id="Vote" class="tabcontent">
<div class="card">
	  <h3>Vote for your favorite design, or submit your own!</h3>
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
          '<th>Image</th> ',
          '<th>Instructions</th>',
        '</tr>';

        for($i = 0; $i < count($currentData); $i++){
          // I think this is what you were going for? ~Isabel
          $image = "<img width=50% src=contest/" . $currentData[$i]["image"] . ">";
          $description = file_get_contents("contest/" . $currentData[$i]["text"]); // Tried to adjust from json changes ~Isabel
      
          echo'<tr>',
          '<td>'.$image.'</td>',
          '<td>'.$description.'</td>',
          '</tr>';
  }
  
  echo '</table>';

}
?>
<br><br><br><br>
<form action="php/upload.php" method="post" enctype="multipart/form-data">
  Select your files. Please upload one text file and one image: <br>
  <input  type="file" name="fileToUpload[]" id="fileToUpload" multiple="multiple" />
  <input type="submit" value="Upload File" name="submit">
</form>
</div>
</div>