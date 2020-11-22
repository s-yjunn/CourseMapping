<?php

$comp = file_get_contents("../data/contest.json");
$compData = json_decode($comp, true);
$currentSubs = $compData["submissions"];
$numCur = count($currentSubs);

$potentialSubs = $_POST['currentSubs'];

$numPtn = count($potentialSubs);

$move = [];

$j = 0;

for($i = 0; $i < $numPtn; $i++){

    if(in_array($currentSubs[$i]["author"]."/".$currentSubs[$i]["title"], $potentialSubs)){

        $move[$j] = $currentSubs[$i];

        $j++;

    }    

}

$submissions = [];

$h = 0;

for($i = 0; $i < $numCur; $i++){

    if(!(in_array($currentSubs[$i], $move))){

        $submissions[$h] = $currentSubs[$i];

        $h++;

    }

}

//update submissions
$compData["submissions"] = $submissions;

//subissions index
$k = count($compData["contestants"]);
//update contestants
for($i = 0; $i < count($move); $i++){
    //add to array of contestants
    $compData["contestants"][$k] = $move[$i];
    //inc index
    $k++;

}
//update json file
$jsondata = json_encode($compData, true);

file_put_contents("../data/contest.json", $jsondata);

header("Location: ../index.php");

?>