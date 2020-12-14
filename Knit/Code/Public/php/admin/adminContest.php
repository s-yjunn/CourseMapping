<button class="btn1" onclick="hide('adminContest'); show('adminHome')"><i class="fas fa-arrow-left"></i> Back</button><br><br>

<h4>Contest</h4>

<div class="section"  id="section1">
  
<h4>Approve</h4>
<?php 

$comp = file_get_contents("data/contest.json");
$compData = json_decode($comp, true);
$currentSubs = $compData["submissions"];
$numSubs = count($currentSubs);

 

if($numSubs > 0):?>
        <p>Current unapproved submissions:</p>
        <ul style="list-style-type:square;">
     <?php for($i = 0; $i < $numSubs; $i++):?>
        <li><a href="imgs/contest/<?=$currentSubs[$i]["image"]?>" target="_blank"><?=$currentSubs[$i]["author"]."/".$currentSubs[$i]["title"]?></a><br /></li>
     <?php endfor; ?>
     </ul>
     <p>Please select the submissions you that you would like to appove.</p>
     <p>Press Ctr + Click to select multiple submissions:</p>
    <form>
    <select id="currentSubs" multiple="multiple" size="<?= $numSubs; ?>">
    <?php for($i = 0; $i < $numSubs; $i++):?>
        <option value="<?=$currentSubs[$i]["author"]."/".$currentSubs[$i]["title"]?>"> <a href="imgs/contest/<?=$currentSubs[$i]["image"]?>" target="_blank"><?=$currentSubs[$i]["author"]."/".$currentSubs[$i]["title"]?></a><br />
    <?php  endfor;?>
    <br>
    </select></form>
    <button class="btn1" id="approve">Approve</button>
    <?php else:?>
        <p>There are currently no new submissions.</p>
<?php endif;?>

</div>

<div class="section" id="section2">

<h4>Delete</h4>

<ul style="list-style-type:square;">
     <?php for($i = 0; $i < $numSubs; $i++):?>
        <li><a href="imgs/contest/<?=$currentSubs[$i]["image"]?>" target="_blank"><?=$currentSubs[$i]["author"]."/".$currentSubs[$i]["title"]?></a><br /></li>
     <?php endfor; ?>
     </ul>

<?php 

if($numSubs > 0):?>
        <p>Please select the submissions you that you would like to delete:</p>
        <p>Press Ctr + Click to select multiple submissions:</p>
    <form>
    <select id="deleteSubs" multiple="multiple" size="<?= $numSubs; ?>">
    <?php for($i = 0; $i < $numSubs; $i++):?>
        <option value="<?=$currentSubs[$i]["author"]."/".$currentSubs[$i]["title"]?>"> <a href="imgs/contest/<?=$currentSubs[$i]["image"]?>" target="_blank"><?=$currentSubs[$i]["author"]."/".$currentSubs[$i]["title"]?></a><br />
    <?php  endfor;?>
    <br>
    </select></form>
    <button class="btn1" id="delete">Delete</button>
    <?php else:?>
        <p>No submissions available. Check again later.</p>
<?php endif;?>

</div>
<div class="section" id="section3">
<h4>Preview Winners</h4>

<?php 
$comp = file_get_contents("data/contest.json");
$compData = json_decode($comp, true);
$currentConts = $compData["contestants"];
$numCont = count($currentConts);

if($numCont == 0):?>

    <p>There are currently no approved contestants.</p>


<?php else:?>
    <p>Current contestants:</p>
     <ul style="list-style-type:square;">
     <?php for($i = 0; $i < $numCont; $i++):?>
        <li><a href="imgs/contest/<?=$currentConts[$i]["image"]?>" target="_blank"><?=$currentConts[$i]["author"]."/".$currentConts[$i]["title"]?></a><br /></li>
     <?php endfor; ?>
     </ul>    
     <?php endif;
 if($numCont > 0):?>
<p>How many winners do you want there to be?</p>
<form  name="numWin">
<input type="number" id="numWinners" name="numWinners" min="1" max="<?= $numCont ?>">
</form>
<br><br>
<button class="btn1" id="showWin">Preview Winners</button>
<button class="btn1" id="confirm" style="display: none;">Confirm Winners</button>
<?php endif; ?>
</div>

    
<div id="preview"></div></div>

<script src="js/contestAdmin.js"></script>
