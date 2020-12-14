<?php 
//get
$comp = file_get_contents("../data/contest.json");
$compData = json_decode($comp, true);
$numCont = count($compData["contestants"]);
$compData["winners"] = $compData["pending"];
$currentConts = $compData["contestants"];
//will hold imgs
$delete = [];
//loop through all contestants
for($i = 0; $i < $numCont; $i++){
//if the contestant is not a winner...
    if(!(in_array($currentConts[$i], $compData["winners"]))){
        //...and the img is not already in the array
        if(!in_array($currentConts[$i]["image"], $delete)){
            //add to delete array
            $delete[$k] = $currentConts[$i]["image"];
        }
    }

}
//reset pending
$compData["pending"] = [];
$delDir = '../imgs/contest/';
for($i = 0; $i < count($delete); $i++){
    //delete all photos
    unlink($delDir.$delete[$i]);
}
//reset contestants
$compData["contestants"] = [];
//save
$jsondata = json_encode($compData, true);
file_put_contents("../data/contest.json", $jsondata);

?>