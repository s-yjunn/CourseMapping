<?php
  // This file formats a pattern submission given its index in the json file
  // (loaded into the contest voting/ winners pages)
  // @author Isabel + styling by Alexis

  //Get all posts (since this is called from outside contest proper)
  $compData = json_decode(file_get_contents("../data/contest.json"), true);
  
  //Where is this being loaded?
  $to = $_GET["to"];
  //Which tab is this being requested from?
  $from = $_GET['from'];
  //Which div do we want to link to on "back"?
  $fromLink = $_GET['fromLink'];

  //Get the proper submission
  $patternIndex = $_GET['index'];

  if ($from === "featuredHome") {
    $pattern = $compData["winners"][$patternIndex];
  } else if ($from === "contestHome") {
    $pattern = $compData["contestants"][$patternIndex];
  } else if ($from === "adminContest") {
    $pattern = $compData["submissions"][$patternIndex];
  } else if ($from === "adminContest2") {
    $from = "adminContest"; // this is a last-minute fix, not ideal
    $pattern = $compData["contestants"][$patternIndex];
  } else {
    echo "Something's wrong.";
    exit;
  }

?>

<a href= "#<?= $fromLink; ?>" onclick="hide('<?= $to; ?>'); show('<?= $from; ?>')"><img src="imgs/quizzes/backbutton.jpg" alt="back button" class="backBtnImg"></a><br><br>

<div id="mainPattern">
  <img class="fullImg" src='imgs/contest/<?= $pattern["image"]; ?>' alt='Knit submission by <?= $pattern["author"]; ?>'>
  <h4><?=$pattern["title"]; ?></h4>
  <h5 class="author"><?=$pattern["author"]; ?></h5>
  <div class="instructions">
	  <p><?=$pattern["text"]; ?></p>
	 </div>
</div>