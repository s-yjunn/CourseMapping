<?php
/* This is the page for contest portion of the admin page
@author Bethany + styling by Alexis, pattern links by Isabel
Last modified 12/16/2020 */	
?>
<!-- "button" to return to main admin tab -->
<img src="imgs/quizzes/backbutton.jpg" alt="back button" class="backBtnImg" onclick="hide('adminContest'); show('adminHome')"><br><br>

<!-- title -->
<h4>Contest</h4>

<div class="section"  id="section1">
  
<h5>Approve</h5>
<?php 
//get current contest data
$comp = file_get_contents("data/contest.json");
$compData = json_decode($comp, true);
//get submissions data
$currentSubs = $compData["submissions"];
$numSubs = count($currentSubs);

//if there are unapproved submissions....
if($numSubs > 0):?>
        <p>Current unapproved submissions:</p>
        <!-- bullet submissions -->
        <ul style="list-style-type:square;">
    <!-- loop over submissions -->
     <?php for($i = 0; $i < $numSubs; $i++):?>
        <!-- make bullet a hyperlink so admin can review submission -->
        <li><a onclick="openPattern(<?= $i; ?>, 'adminPattern', 'adminContest', 'section1')"><?=$currentSubs[$i]["title"]?></a> by <?= $currentSubs[$i]["author"]; ?></a></li>
     <?php endfor; ?>
     </ul>
     <p>Please select the submissions you that you would like to appove.</p>
     <p>Press Ctr + Click to select multiple submissions:</p>
    <form>
        <!-- show list of submissions for admin to approve (in previous list admin could not select items)-->
    <select id="currentSubs" multiple="multiple" size="<?= $numSubs; ?>">
    <?php for($i = 0; $i < $numSubs; $i++):?>
        <option value="<?=$currentSubs[$i]["author"]."/".$currentSubs[$i]["title"]?>"> <?=$currentSubs[$i]["title"]?> by <?= $currentSubs[$i]["author"]; ?><br />
    <?php  endfor;?>
    <br>
    </select></form>
    <!-- if there are no unapproved submissions.... -->
    <?php else:?>
        <!-- ....show msg -->
        <p>There are currently no new submissions.</p>
<?php endif;?>
    <!-- if there are submissions.... -->
<?php if($numSubs > 0):?>
    <!-- show approve button -->
    <button class="btn1" id="approve">Approve</button>
<?php endif; ?>

</div>

<div class="section" id="section2">

<h5>Delete</h5>
<!-- bullet submissions -->
<ul style="list-style-type:square;">
    <!-- loop over submissions -->
     <?php for($i = 0; $i < $numSubs; $i++):?>
        <!-- make bullet a hyperlink so admin can review submission -->
        <li><a onclick="openPattern(<?= $i; ?>, 'adminPattern', 'adminContest', 'section2')"><?=$currentSubs[$i]["title"]?></a> by <?= $currentSubs[$i]["author"]; ?></a></li>
     <?php endfor; ?>
     </ul>

<?php 
//if there are unapproved submissions....
if($numSubs > 0):?>
        <p>Please select the submissions you that you would like to delete:</p>
        <p>Press Ctr + Click to select multiple submissions:</p>
    <form>
    <!-- show list of submissions for admin to delete (in previous list admin could not select items)-->
    <select id="deleteSubs" multiple="multiple" size="<?= $numSubs; ?>">
    <?php for($i = 0; $i < $numSubs; $i++):?>
        <option value="<?=$currentSubs[$i]["author"]."/".$currentSubs[$i]["title"]?>"><?=$currentSubs[$i]["title"]?> by <?= $currentSubs[$i]["author"]; ?><br />
    <?php  endfor;?>
    <br>
    </select></form>
    <!-- if there are no unapproved submissions.... -->
    <?php else:?>
        <!-- ....show msg -->
        <p>No submissions available. Check again later.</p>
<?php endif; ?>
<!-- if there are submissions.... -->
<?php if($numSubs > 0):?>
    <!-- show delete button -->
<button class="btn1" id="delete">Delete</button>
<?php endif; ?>

</div>

<div class="section" id="section3">
<h5>Preview Winners</h5>

<?php 
//get contestants' data
$comp = file_get_contents("data/contest.json");
$compData = json_decode($comp, true);
$currentConts = $compData["contestants"];
$numCont = count($currentConts);
//if there are no contestants
if($numCont == 0):?>
    <!-- show msg -->
    <p>There are currently no approved contestants.</p>
<!-- if there are contestants -->
<?php else:?>
    <p>Current contestants:</p>
    <!-- bullet contestants -->
     <ul style="list-style-type:square;">
     <!-- loop over contestants -->
     <?php for($i = 0; $i < $numCont; $i++):?>
        <!-- make bullet a hyperlink so admin can review submission -->
        <li><a onclick="openPattern(<?= $i; ?>, 'adminPattern', 'adminContest2', 'section3')"><?=$currentConts[$i]["title"]?></a> by <?= $currentConts[$i]["author"]; ?></a></li>
     <?php endfor; ?>
     </ul>    
     <?php endif;?>
	 
     <p>How many winners do you want there to be?</p>
     <!-- show text box for admin to select number of winners  -->
	 <form  name="numWin">
	 <input type="number" id="numWinners" name="numWinners" min="1" max="<?= $numCont ?>">
	 </form>
     <br>
     <!-- button to preview winners -->
     <button class="btn1" id="showWin">Preview Winners</button>
     <!-- button to confirm winners -->
	 <button class="btn1" id="confirm" style="display: none;">Confirm Winners</button>
	 
	
 </div>
<!-- will show slideshow preview -->    
<div id="preview"></div></div>

<script src="js/contestAdmin.js"></script>
