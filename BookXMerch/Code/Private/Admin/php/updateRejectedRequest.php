<?php 
    session_start();
    $loggedUser = $_SESSION["username"]; 

    $fn  = $_POST['fn'];
    $toRemove  = $_POST['toRemove'];

    $testJSON = file_get_contents("../pendingReq.JSON");
    $rows= json_decode($testJSON, true);
    $new = [];

    if(sizeof($fn)==0) {
        $new=[]; 
    }  else {
        $i=0;
        foreach ($rows as $key => $jsons) { 
            $i++;
            $t = "t".$i;
            //ONLY keep the non-rejected requests
            if(!($toRemove[0]==$t)) {
                array_push($new,$jsons);  
                
            }
        }
    }
    $rows=$new;
    $resJSON = json_encode($rows, JSON_PRETTY_PRINT);
    file_put_contents("../pendingReq.JSON", $resJSON);
?>