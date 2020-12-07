<?php 
      //get json
      $comp = file_get_contents("../data/contest.json");
      $compData = json_decode($comp, true);
      //get user index
      $i = $_POST["index"];
      //inc vote
      $compData["contestants"][$i]["votes"] += 1;
      //save update
      $jsondata = json_encode($compData, true);
      file_put_contents("../data/contest.json", $jsondata);

  ?>
  