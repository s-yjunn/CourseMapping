<!-- Author: Imane Berrada | Date: Dec 7th, 2020--> 
<?php 
    session_start();
    $loggedUser = $_SESSION["username"]; 

    $fn  = $_POST['fn'];
    $toRemove  = $_POST['toRemove'];

    $testJSON = file_get_contents("../../Books/BookDefault/Pending/allPendingBooks.json");
    $rowsAll= json_decode($testJSON, true);
    $rows = $rowsAll['requests'];
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
    $rowsAll["requests"]=$new;
    $resJSON = json_encode($rowsAll, JSON_PRETTY_PRINT);
    file_put_contents("../../Books/BookDefault/Pending/allPendingBooks.json", $resJSON);
?>