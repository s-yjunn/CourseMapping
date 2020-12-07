<button class="btn1" onclick="hide('adminContest'); show('adminHome')"><i class="fas fa-arrow-left"></i> Back</button><br><br>

<h4>Contest</h4>

<div class="section">
  
<h5>Approve</h5>
<?php 

$comp = file_get_contents("data/contest.json");
$compData = json_decode($comp, true);
$currentSubs = $compData["submissions"];
$numSubs = count($currentSubs);

if($numSubs == 0){

echo "There are currently no new submissions.";

}
else{

    echo '<p>Current unapproved submissions:</p>';

echo '<form action="php/moveConts.php" method="post">';

for($i = 0; $i < $numSubs; $i++){
    echo '<input type="checkbox" name="currentSubs[]" value="'.$currentSubs[$i]["author"]."/".$currentSubs[$i]["title"].'" /> <a href="imgs/contest/'.$currentSubs[$i]["image"].'" target="_blank">'.$currentSubs[$i]["author"]."/".$currentSubs[$i]["title"].'</a><br />';
}

echo '<br>',
'<input class="btn1" type="submit" value="Approve">',
'</form>';

}

?>

</div>

<div class="section">

<h5>Delete</h5>

<?php 

if($numSubs > 0){

        echo '<p>Please select the submissions you that you would like to delete:</p>';
    
    echo '<form action="php/deleteConts.php" method="post">';
    
    for($i = 0; $i < $numSubs; $i++){
        echo '<input type="checkbox" name="deleteSubs[]" value="'.$currentSubs[$i]["author"]."/".$currentSubs[$i]["title"].'" /> <a href="imgs/contest/'.$currentSubs[$i]["image"].'" target="_blank">'.$currentSubs[$i]["author"]."/".$currentSubs[$i]["title"].'</a><br />';
    }
    
    echo '<br>',
    '<input class="btn1" type="submit" value="Delete">',
    '</form>';
    
    }

$currentConts = $compData["contestants"];
$numCont = count($currentConts);

?>

</div>

<div class="section">

<h5>Preview Winners</h5>

<?php 

if($numCont == 0){

    echo "There are currently no approved contestants.";

}
else{

    echo "Current contestants:",
     '<ul style="list-style-type:square;">';
     for($i = 0; $i < $numCont; $i++){
        echo '<li><a href="imgs/contest/'.$currentConts[$i]["image"].'" target="_blank">'.$currentConts[$i]["author"]."/".$currentConts[$i]["title"].'</a><br /></li>';
     }
     echo '</ul>';     
     ?>

<p>How many winners do you want there to be?</p>
<form  name="numWin">
<input type="number" id="numWinners" name="numWinners" min="1" max="<?= $numCont ?>">
</form>
<br><br>
<button class="btn1" id="showWin">Preview Winners</button>

</div>
    <?php }?>
<div id="preview" style="display: none;">
<?php include "php/preview.php"; ?>
<button class="btn1" id="confirm">Confirm Winners</button>
</div>

<script>

$("#showWin").click(function(){
  var numWinners = document.forms["numWin"]["numWinners"].value;
$.ajax({
type: "POST",
url: "php/moveWin.php",
data: {numWinners:numWinners},
success: function(result) {
    console.log(result);
                
}
})
$.get("php/preview.php", function(){
    $("#preview").show();
  });
});

$("#confirm").click(function(){
    $.get("php/reset.php", function(){
    $("#preview").hide();
  });
});

</script>