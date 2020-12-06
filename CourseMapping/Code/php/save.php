<?php 
    session_start();
    
    // file paths:
    $userpath = "../json/users.json";
    
    $users = json_decode(file_get_contents($userpath), TRUE);
    $successful = false;

    // If the user does not have a folder of stored pathways, make one.
    $userFile = "../users/u_" . $users[$_SESSION['username']]["id"];
    if(!file_exists($userFile)) {
        if(!mkdir($userFile)) {
            echo "Couldn't create user file. ";
        }
    }
     
    $pathway = json_decode(file_get_contents('php://input'), FALSE);
    // If this pathway has an id, it must already exist in the user's folder.
    // If not, give it an id that is different from the pathways already stored.
    if(!isset($pathway->serverFile)) {
        $id = "p_" . count(scandir($userFile));
        $pathway->serverFile = $id;
        // echo "Set serverID to " . $id . ". "; (Debugging)

    }   
    // Save or make then save the file
    $file = fopen($userFile . "/" . $pathway->serverFile, "w");
    if(!$file) {
        echo "Couldn't open file to save in"; //: " . $userFile . "/" . $pathway->serverFile;  (Debugging)
        // echo var_dump($pathway->serverFile);  (Debugging)

    } else {
        if(!fwrite($file, json_encode($pathway))){
            echo "Could Not Save Pathway";
        } else {
            echo "Pathway Saved";
            $successful = true;
        }
        fclose($file); 
    }
    // single character flag at the end to make it easy to determine if the save was successful from the code
    if($successful) {
        echo "1";
    } else {
        echo "0";
    }
 ?>