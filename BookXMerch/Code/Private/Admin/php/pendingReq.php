<?php 

    echo "<script type='text/javascript' src='../js/scriptAdmin.js'> </script>";
    session_start();

    if(isset($_SESSION["name"])) {
        $loggedUser = $_SESSION["username"];
    } 

    $reqsJSON = file_get_contents("../pendingReq.JSON");
    $rows= json_decode($reqsJSON, true);


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
                
            echo "<div class='task-card ".$element[2]."' id='t".$i."'>
                <div class='status-icon'></div>
                    <p class='task-text'>".$element[1]."</p>
                    <p class='task-status ".$color."'>".$element[2]."</p>
                    <ion-icon class='delete fs-large mg-10' name='close-circle-outline'></ion-icon>
                    <p class='task-id' style='display:none'>".$element[0]."</p>
                </div>";
 
        }
        echo "<div id='readingSize' style='display:none'>".sizeof($readingList)."</div>";
        
    }

?>