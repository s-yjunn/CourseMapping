<?php 
    // file paths:
    $userpath = "../json/users.json";

    // $users = json_decode(file_get_contents($userpath), FALSE);
    // If the user does not have a folder of stored pathways, make one.
    if(!file_exists($_SESSION['username'])) {
        mkdir($_SESSION['username']);
    }
    
    $pathway = json_decode(file_get_contents('php://input'), FALSE);
    // If this pathway has an id, it must already exist in the user's folder.
    // If not, give it an id that is different from the pathways already stored.
    if(!isset($pathway->id)) {
        $id = "p_" . count(scandir($_SESSION['username']));
        $pathway->id = $id;
    }
    // Save or make then save the file
    $file = fopen($_SESSION['username'] . "/" . $pathway->id, "w");
    if($file) {
        $success = fwrite($file, json_encode($pathway));
        fclose($file);  
    } else {
        $success = FALSE;
    }
    echo $success ? "Pathway Saved" : "Could Not Save Pathway";
 ?>