<?php 
//get
$comp = file_get_contents("../data/contest.json");
$compData = json_decode($comp, true);

$myfile = fopen("../temp/numConts.txt", "w") or die("Unable to open file!");
fwrite($myfile, count($compData["contestants"]));
fclose($myfile);


?>