<?php

$comp = file_get_contents("../data/contest.json");
$compData = json_decode($comp, true);
$currentSubs = $compData["submissions"];
$numCur = count($currentSubs);
$delDir = '../imgs/contest/';
$deleteSubs = $_POST['deleteSubs'];

$numPtn = count($deleteSubs);

$move = [];

$j = 0;

for($i = 0; $i < $numPtn; $i++){

    if(in_array($currentSubs[$i]["author"]."/".$currentSubs[$i]["title"], $deleteSubs)){

        $move[$j] = $currentSubs[$i];

        $j++;

    }    

}

$currentSubs = $compData["submissions"];
$numCur = count($currentSubs);

$submissions = [];

$delete = [];

$h = 0;

$k = 0;

for($i = 0; $i < $numCur; $i++){

    if(!(in_array($currentSubs[$i], $move))){

        $submissions[$h] = $currentSubs[$i];

        $h++;

    }
    else{

        $delete[$k] = $currentSubs[$i]["image"];

    }

}

for($i = 0; $i < count($delete); $i++){

    unlink($delDir.$delete[$i]);

}

//update submissions
$compData["submissions"] = $submissions;

//update json file
$jsondata = json_encode($compData, true);

file_put_contents("../data/contest.json", $jsondata);

header("Location: ../index.php");

?>