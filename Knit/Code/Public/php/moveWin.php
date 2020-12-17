<?php
/* This is to move the winning contestants for admin to preview
@author Bethany
Last modified 12/16/2020 */

//get json info
$comp = file_get_contents("../data/contest.json");
$compData = json_decode($comp, true);
$currentConts = $compData["contestants"];
$numCont = count($currentConts);
//will hold all votes
$votes = [];
//add all votes to $votes array
for($i = 0; $i < $numCont; $i++){
    $votes[$i] = $currentConts[$i]["votes"];
}
//sort votes from highest to lowest
rsort($votes);
//will use to hold ordered submissions
$ordered = [];
//iterate over votes
for($i = 0; $i < count($votes); $i++){
    for($j = 0; $j < $numCont; $j++){
        //if number of votes matches contestant....
        if($votes[$i] == $currentConts[$j]["votes"]){
            //....and the contestant is not already in array
            if(!(in_array($currentConts[$j], $ordered))){
                //add to array
                $ordered[$i] = $currentConts[$j];
            }
            continue;
        }
    }
}
//get desired number of winners
$numWinners = $_POST['numWinners'];
//will hold winners
$winners = [];
//index for winners
$j = 0;
//add desired number of winners to array
for($i = 0; $i < $numWinners; $i++){
    //as long as the vote is higher than zero
    if($ordered[$i]["votes"] > 0){
    //add to array
    $winners[$j] = $ordered[$i];    
    //inc index
    $j++;
    }
}

if($numWinners < count($ordered)){
    for($m = $numWinners; $m < count($ordered); $m++){
        //echo $ordered[$m]["votes"]."\n";
        //if there is a tie
        if($ordered[$m]["votes"] == $winners[$numWinners - 1]["votes"]){
            //add to array
            $winners[$j] = $ordered[$m];
            //inc index
            $j++;
        }

    }
}
//update pending
$compData["pending"] = $winners;
//update json file
$jsondata = json_encode($compData, true);
file_put_contents("../data/contest.json", $jsondata);

?>