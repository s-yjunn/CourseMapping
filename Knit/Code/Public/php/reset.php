<?php 

$comp = file_get_contents("../data/contest.json");
$compData = json_decode($comp, true);
$numCont = count($compData["contestants"]);
$compData["winners"] = $compData["pending"];
$compData["pending"] = [];
$delDir = '../imgs/contest/';
for($i = 0; $i < $numCont; $i++){
    unlink($delDir.$compData["contestants"][$i]["image"]);
}

$compData["contestants"] = [];

$jsondata = json_encode($compData, true);
file_put_contents("../data/contest.json", $jsondata);

?>