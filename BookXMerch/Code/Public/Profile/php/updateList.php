<!-- Author: Imane Berrada | Date: Nov 30th, 2020--> 
<?php 
    session_start();
    $loggedUser = $_SESSION["username"]; 

    $fn  = $_POST['fn'];
    $str = $_POST['str'];

    $testJSON = file_get_contents("../../../Private/Users/allUsers.JSON");
    $rows= json_decode($testJSON, true);

    foreach ($rows["users"] as $key => $jsons) { 
            if($jsons["username"]==$loggedUser) {
                $readingList= $rows["users"][$key]["readingList"];
                $userKey = $key;
            break;
        }
    }

    if(is_null($fn)) {
        $fn=[]; 
    } 
    $readingList = $fn;

    $rows["users"][$userKey]["readingList"] = $readingList;

    $resJSON = json_encode($rows, JSON_PRETTY_PRINT);
    file_put_contents("../../../Private/Users/allUsers.JSON", $resJSON);
?>