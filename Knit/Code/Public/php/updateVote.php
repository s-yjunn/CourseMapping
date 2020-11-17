<?php 
  
  $comp = file_get_contents("../data/contest.json");
$compData = json_decode($comp, true);
$currentData = $compData["contestants"];

        for($i = 0; $i < count($currentData); $i++){
          $user = $currentData[$i]["author"];      
          if($GLOBALS['user'] == $user){
            $numVotes = $currentData[$i]["votes"];
            
            $numVotes += 1;

            $currentData[$i]["votes"] = $numVotes;

            $jsondata = json_encode($compData, true);

            file_put_contents("../data/contest.json", $jsondata);

          break;

          }
          else{
            continue;
          }
  }

  
  ?>