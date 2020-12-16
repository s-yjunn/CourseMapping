<?php
/* 
@author Bethany + styling by Alexis, pattern links by Isabel
Last modified 12/16/2020 */	
?>

<img src="imgs/quizzes/backbutton.jpg" alt="back button" class="backBtnImg" onclick="hide('adminContest'); show('adminHome')"><br><br>


<h4>Contest</h4>

<div class="section"  id="section1">
  
<h5>Approve</h5>
<?php 

$comp = file_get_contents("data/contest.json");
$compData = json_decode($comp, true);
$currentSubs = $compData["submissions"];
$numSubs = count($currentSubs);

 

if($numSubs > 0):?>
        <p>Current unapproved submissions:</p>
        <ul style="list-style-type:square;">
     <?php for($i = 0; $i < $numSubs; $i++):?>
        <li><a onclick="openPattern(<?= $i; ?>, 'adminPattern', 'adminContest', 'section1')"><?=$currentSubs[$i]["title"]?></a> by <?= $currentSubs[$i]["author"]; ?></a></li>
     <?php endfor; ?>
     </ul>
     <p>Please select the submissions you that you would like to appove.</p>
     <p>Press Ctr + Click to select multiple submissions:</p>
    <form>
    <select id="currentSubs" multiple="multiple" size="<?= $numSubs; ?>">
    <?php for($i = 0; $i < $numSubs; $i++):?>
        <option value="<?=$currentSubs[$i]["author"]."/".$currentSubs[$i]["title"]?>"> <?=$currentSubs[$i]["title"]?> by <?= $currentSubs[$i]["author"]; ?><br />
    <?php  endfor;?>
    <br>
    </select></form>
    
    <?php else:?>
        <p>There are currently no new submissions.</p>
<?php endif;?>

<?php if($numSubs > 0):?>
    <button class="btn1" id="approve">Approve</button>
<?php endif; ?>


</div>

<div class="section" id="section2">

<h5>Delete</h5>

<ul style="list-style-type:square;">
     <?php for($i = 0; $i < $numSubs; $i++):?>
        <li><a onclick="openPattern(<?= $i; ?>, 'adminPattern', 'adminContest', 'section2')"><?=$currentSubs[$i]["title"]?></a> by <?= $currentSubs[$i]["author"]; ?></a></li>
     <?php endfor; ?>
     </ul>

<?php 

if($numSubs > 0):?>
        <p>Please select the submissions you that you would like to delete:</p>
        <p>Press Ctr + Click to select multiple submissions:</p>
    <form>
    <select id="deleteSubs" multiple="multiple" size="<?= $numSubs; ?>">
    <?php for($i = 0; $i < $numSubs; $i++):?>
        <option value="<?=$currentSubs[$i]["author"]."/".$currentSubs[$i]["title"]?>"><?=$currentSubs[$i]["title"]?> by <?= $currentSubs[$i]["author"]; ?><br />
    <?php  endfor;?>
    <br>
    </select></form>
    <?php else:?>
        <p>No submissions available. Check again later.</p>
<?php endif; ?>

<?php if($numSubs > 0):?>
<button class="btn1" id="delete">Delete</button>
<?php endif; ?>

</div>

<div class="section" id="section3">
<h5>Preview Winners</h5>

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
        <li><a onclick="openPattern(<?= $i; ?>, 'adminPattern', 'adminContest2', 'section3')"><?=$currentConts[$i]["title"]?></a> by <?= $currentConts[$i]["author"]; ?></a></li>
     <?php endfor; ?>
     </ul>    
     <?php endif;?>
	 
	 <?php //if($numCont > 0):?>
	 <p>How many winners do you want there to be?</p>
	 <form  name="numWin">
	 <input type="number" id="numWinners" name="numWinners" min="1" max="<?= $numCont ?>">
	 </form>
	 <br>
	 <button class="btn1" id="showWin">Preview Winners</button>
	 <button class="btn1" id="confirm" style="display: none;">Confirm Winners</button>
	 <?php //endif; ?>
	
 </div>
    
<div id="preview"></div></div>

<script src="js/contestAdmin.js"></script>
