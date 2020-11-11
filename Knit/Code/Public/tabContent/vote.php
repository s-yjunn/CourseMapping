<div id="Vote" class="tabcontent">
<div class="card">
	  <h3>Vote for your favorite design, or submit your own!</h3>
    <?php
 $contest = glob('images/contest/*'); 
$numPics = count($contest);
if($numPics == 0){
    echo '<p>There are currently no submissions! Please come back later for updates.</p>';    
    }
    else{
      echo '<br>',
      '<table style="width:100%">',
        '<tr>',
          '<th>Pattern</th> ',
          '<th>Description</th>',
        '</tr>';

        $subs = file_get_contents("../json/contestSubs/submissions.json");
        $currentData = json_decode($subs, true);

        for($i = 0; $i < $numPics; $i++){

          $image = $currentData[$i][1];
          $description = $currentData[$i][2];
      
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