<?php 

$comp = file_get_contents("../data/contest.json");
$compData = json_decode($comp, true);

$compData["submissions"] = [];
$compData["contestants"] = [];
$compData["winners"] = [];

$jsondata = json_encode($compData, true);
file_put_contents("../data/contest.json", $jsondata);
header("Location: ../index.php");

?>