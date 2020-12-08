<div id="adminPage">

<h3 class="underline">Manage Site</h3>

<div class="section" id="section1">
  
<h4>Approve</h4>
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

<div class="section" id="section2">

<h4>Delete</h4>

<?php 

$comp = file_get_contents("data/contest.json");
$compData = json_decode($comp, true);
$currentSubs = $compData["submissions"];
$numSubs = count($currentSubs);

if($numSubs > 0):?>
        <p>Please select the submissions you that you would like to delete:</p>
    <form name="delS">
    <?php for($i = 0; $i < $numSubs; $i++):?>
        <input type="checkbox" name="deleteSubs[]" value="<?=$currentSubs[$i]["author"]."/".$currentSubs[$i]["title"]?>" /> <a href="imgs/contest/<?=$currentSubs[$i]["image"]?>" target="_blank"><?=$currentSubs[$i]["author"]."/".$currentSubs[$i]["title"]?></a><br />
    <?php  endfor;?>
    <br>
    </form>
<?php endif;?>

</div>

<div class="section">
    <button class="btn1" id="delete">Delete</button>
</div>
<div class="section" id="section3"></div>

<div class="section"  id="secton3Buttons">
<p>How many winners do you want there to be?</p>
<form  name="numWin">
<input type="number" id="numWinners" name="numWinners" min="1" max="<?= $numCont ?>">
</form>
<br><br>
<button class="btn1" id="showWin">Preview Winners</button>
<button class="btn1" id="confirm">Confirm Winners</button>
</div>
    
<div id="preview"></div>

</div>

<script>
$(document).ready(function(){
    $("#confirm").hide();
    $("#section3").load("php/section3.php"); 
});
$("#showWin").click(function(){
  var numWinners = document.forms["numWin"]["numWinners"].value;
$.ajax({
type: "POST",
url: "php/moveWin.php",
data: {numWinners:numWinners},
success: function() {
    $("#preview").load("php/preview.php");   
    $("#confirm").show();     
}
});      

$("#showWin").show();
});

$("#confirm").click(function(){
    $.get("php/reset.php", function(){
    $("#confirm").hide();
    $("#preview").hide();
    $("#section3").load("php/section3.php");
  });
});
$("#delete").click(function(){
    var deleteSub = [];
        $.each($("#deleteSubs option:selected"), function(){            
            deleteSub.push($(this).val());
        });
$.ajax({
type: "POST",
url: "php/deleteConts.php",
data: {deleteSubs:deleteSub},
success: function() {
    alert("in success");
    $("#section2").load(location.href+" #section2>*","");
    $("#section1").load(location.href+" #section1>*","");    
}
});      
});
</script>
