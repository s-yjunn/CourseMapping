<?php
/* This is to delete the submissions that admin did not approve
@author Bethany
Last modified 12/16/2020 */

//get submissions data
$comp = file_get_contents("../data/contest.json");
$compData = json_decode($comp, true);
$currentSubs = $compData["submissions"];
$numCur = count($currentSubs);
$delDir = '../imgs/contest/';
//get selected submissions
$deleteSubs = $_POST['deleteSubs'];
//get number of selected submissions
$numPtn = count($deleteSubs);
//will hold submissions that will be deleted
$move = [];
//index for $move
$j = 0;
//loop through num subs to be deleted
for($i = 0; $i < $numPtn; $i++){
    //if sub was selected
    if(in_array($currentSubs[$i]["author"]."/".$currentSubs[$i]["title"], $deleteSubs)){
        //move
        $move[$j] = $currentSubs[$i];
        //inc
        $j++;

    }    
}
//will hold submissions to keep
$submissions = [];
//will hold imgs to delete
$delete = [];
//index for $submissions
$h = 0;
//index for $delete
$k = 0;
//loop over all submissions
for($i = 0; $i < $numCur; $i++){
    //if submission has not been selected to move
    if(!(in_array($currentSubs[$i], $move))){
        //keep
        $submissions[$h] = $currentSubs[$i];
        //inc
        $h++;

    }
    //if submission has been selected to move
    else{
        //if there are no duplicates....
        if(!in_array($currentSubs[$i]["image"], $delete)){
            //add img to array
            $delete[$k] = $currentSubs[$i]["image"];
        }
    }

}
//loop through array
for($i = 0; $i < count($delete); $i++){
    //delete imgs
    unlink($delDir.$delete[$i]);

}

//update submissions
$compData["submissions"] = $submissions;

//update json file
$jsondata = json_encode($compData, true);

file_put_contents("../data/contest.json", $jsondata);

?>