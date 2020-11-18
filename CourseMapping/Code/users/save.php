<?php 
    session_start();
    
    // file paths:
    $userpath = "../json/users.json";

    // Get pathway:
    $pathway = json_decode(file_get_contents('php://input'), TRUE);

    // $users = json_decode(file_get_contents($userpath), FALSE);
    // If the user does not have a folder of stored pathways, make one.
    $user_file_name = "user" . $pathway[$_SESSION['username']];
    if(!file_exists($user_file_name)) {
        if(!mkdir($user_file_name)) {
            echo "Couldn't create user file. ";
        }
    }
    
    // If this pathway has an id, it must already exist in the user's folder.
    // If not, give it an id that is different from the pathways already stored.
    if(!isset($pathway->id)) {
        $id = "p_" . count(scandir($user_file_name));
        $pathway->id = $id;
    }
    // Save or make then save the file
    $file = fopen($user_file_name . "/" . $pathway->id, "w");
    if(!$file) {
        $success = "Couldn't open file to save in";
    } else {
        if(!fwrite($file, json_encode($pathway))){
            $success = "Could Not Save Pathway";
        }
        fclose($file); 
        $success = "Pathway Saved";
    }

    echo $success;
 ?>