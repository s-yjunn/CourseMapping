<?php 

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
        foreach ($readingList as $element) { 

            echo "Title: ". $element[1];
            echo "<br>";
            echo "Author(s): ";
            $i=0;
            foreach($element[2] as $author) {
                $i++;
                echo $author;
                if(sizeof($element[2]) > $i) {
                    echo " | ";
                }
            }
            echo "<br>";
            echo "Genre: ". $element[3];
            echo "<br>";
            echo "<br>";
        }
    }
?>