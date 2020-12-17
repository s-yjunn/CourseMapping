<?php
/* This is to move the submissions that admin did approve
@author Bethany
Last modified 12/16/2020 */

//get submissions data
$comp = file_get_contents("../data/contest.json");
$compData = json_decode($comp, true);
$currentSubs = $compData["submissions"];
$numCur = count($currentSubs);
//get selected subs
$potentialSubs = $_POST['currentSubs'];
//num selected subs
$numPtn = count($potentialSubs);
//will hold selected submissions
$move = [];
//move index
$j = 0;
//loop subs
for($i = 0; $i < $numPtn; $i++){
    //if sub is in $potentialSubs
    if(in_array($currentSubs[$i]["author"]."/".$currentSubs[$i]["title"], $potentialSubs)){
        //more to move srray
        $move[$j] = $currentSubs[$i];
        //inc
        $j++;

    }    

}
//will hold untouched submissions
$submissions = [];
//submissions index
$h = 0;

for($i = 0; $i < $numCur; $i++){
    //if sub was not selected
    if(!(in_array($currentSubs[$i], $move))){
        //keep in submissions
        $submissions[$h] = $currentSubs[$i];
        //inc index
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

?>