<?php
  //This file formats a pattern submission given its index in the json file (for inclusion on the contest voting/ winners pages)

  //Get all posts (since this is called from outside contest proper)
  $compData = json_decode(file_get_contents("../data/contest.json"), true);
  
  //Get the proper submission
  $patternIndex = $_GET['index'];
  $pattern = $compData["contestants"][$patternIndex];
  //Where is this being loaded?
  $to = $_GET["to"];
  //Which tab is this being requested from?
  $from = $_GET['from'];

?>

<button onclick="hide('<?= $to; ?>'); show('<?= $from; ?>')"><i class="fas fa-arrow-left"></i> Go back</button><br><br>

<div id="mainPattern">
  <img src='contest/<?= $pattern["image"]; ?>' alt='Knit submission by <?= $pattern["author"]; ?>'>
  <h4><?=$pattern["title"]; ?></h4>
  <p class="author"><?=$pattern["author"]; ?></p>
  <p class="postContent"><?=$pattern["text"]; ?></p>
</div>