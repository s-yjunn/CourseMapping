<?php

$comp = file_get_contents("../data/contest.json");
$compData = json_decode($comp, true);
$currentConts = $compData["contestants"];
$numCont = count($currentConts);

$votes = [];

for($i = 0; $i < $numCont; $i++){

    $votes[$i] = $currentConts[$i]["votes"];

}

rsort($votes);

$ordered = [];

for($i = 0; $i < count($votes); $i++){

    for($j = 0; $j < $numCont; $j++){
       
        if($votes[$i] == $currentConts[$j]["votes"]){

            if(!(in_array($currentConts[$j], $ordered))){

                $ordered[$i] = $currentConts[$j];

            }

            continue;

        }
    
    }

}

$numWinners = $_POST['numWinners'];

$winners = [];

for($i = 0; $i < $numWinners; $i++){

    $winners[$i] = $ordered[$i];

}

$compData["winners"] = $winners;

//update json file
$jsondata = json_encode($compData, true);

file_put_contents("../data/contest.json", $jsondata);

header("Location: ../index.php");

?>