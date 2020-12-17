<?php 
/* This is to create a temp txt file for a js file that gets the number of contestants
@author Bethany
Last modified 12/16/2020 */

//get contest info
$comp = file_get_contents("../data/contest.json");
$compData = json_decode($comp, true);
//create temp file
$myfile = fopen("../temp/numConts.txt", "w") or die("Unable to open file!");
//save number of contestants
fwrite($myfile, count($compData["contestants"]));
fclose($myfile);


?>