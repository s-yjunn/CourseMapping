<?php

    // file paths:
    $userpath = "json/users.json"; // To general data on users 
    $toUsers = "users"; // The path to get to the users folder, with user data

    $users = json_decode(file_get_contents($userpath), TRUE);
    // If the user does not have a folder of stored pathways, make one.
    $userFile = "u_" . $users[$_SESSION['username']]["id"];
    
    $user_file_path = $toUsers . "/" . $userFile;
?>

<h2>Saved</h2>
<p>Users' input will be automatically imported and able to be open</p>

<div>
<?php
    // Create buttons that open tabs for pathways on the server. 
    $pathwayFiles = scandir($user_file_path);
    $dom = new DOMDocument('1.0');
    foreach($pathwayFiles as $fileName) {
        // If this file is a saved pathway:
        if(substr($fileName, 0, 2) == "p_") {
            $filePath = $user_file_path . "/" . $fileName;
            $pathwayJSON = file_get_contents($filePath);
            $pathway = json_decode($pathwayJSON, TRUE);
            $tabOpener = $dom->createElement('button', $pathway['title']);
            // I know the global event is deprecated, but otherwise I can't add this in PHP where I know the pathway info
            // w3schools also uses the deprecated event.
            $tabOpener->setAttribute("onclick", "openSaved(event, '" . $pathway['title'] . "', '" . $pathwayJSON . "')");
            $dom->appendChild($tabOpener);
        }  
    }
    echo $dom->saveHTML();
?>
</div>