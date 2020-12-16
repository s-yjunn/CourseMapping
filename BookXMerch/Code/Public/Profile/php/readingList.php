<!-- Author: Imane Berrada | Date: Nov 28th, 2020--> 
<?php 

    echo "<script type='text/javascript' src='../js/scriptProfile.js'> </script>";
    session_start();

    if(isset($_SESSION["name"])) {
        $loggedUser = $_SESSION["username"];
    } else {
        header("../../../Public/General/index.php");
    }

    $usersJSON = file_get_contents("../../../Private/Users/allUsers.JSON");
    $rows= json_decode($usersJSON, true);


    echo "<br>";
    foreach ($rows["users"] as $key => $jsons) { 
            if($jsons["username"]==$loggedUser) {
                $readingList= $rows["users"][$key]["readingList"];
            break;
        }
    }

    if(sizeof($readingList)==0) {
        echo "Your reading list is currently empty.";
    } else{
        $i=0;
        foreach ($readingList as $element) { 
            $i++;

            if($element[2]=="Not-Started"){
                $color="color-red";
            } else if ($element[2]=="Completed"){
                $color="color-green";
            } else{
                $color="color-blue";
            }
                
            echo "<div class='task-card-RL ".$element[2]."' id='t".$i."'>
                <div class='status-icon-RL'></div>
                    <p class='task-text-RL'>".$element[1]."</p>
                    <p class='task-status-RL ".$color."'>".$element[2]."</p>
                    <ion-icon class='delete-RL fs-large mg-10' name='close-circle-outline'></ion-icon>
                    <p class='task-id' style='display:none'>".$element[0]."</p>
                </div>";
 
        }
        echo "<div id='readingSize' style='display:none'>".sizeof($readingList)."</div>";
        
    }

?>