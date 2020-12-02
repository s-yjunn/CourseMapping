<?php 

    // $_SESSION['username'] = $_POST['username']; 
    // $_SESSION['name'] = $_POST['name'];
    
    session_start();

    if(isset($_SESSION["name"])) {
        $loggedUser = $_SESSION["username"];
    } else {
        header("../../../Public/General/index.php");
    }
    
    $reviewsJSON = file_get_contents("../../../Private/Books/BookDefault/Reviews/allReviews.json");
    $rows= json_decode($reviewsJSON, true);
    
    
    if($rows[$loggedUser]){
        print_r(json_encode($rows[$loggedUser]));

    } else {
        print_r(json_encode(array())); 

    }


    // foreach ($rows["users"] as $key => $jsons) { 
    //         if($jsons["username"]==$loggedUser) {
    //             $readingList= $rows["users"][$key]["readingList"];
    //         break;
    //     }
    // }
    
    // if(sizeof($readingList)==0) {
    //     echo "Your reading list is currently empty.";
    // } else{
    //     foreach ($readingList as $element) { 
    
    //         echo "Title: ". $element[1];
    //         echo "<br>";
    //         echo "Author(s): ";
    //         $i=0;
    //         foreach($element[2] as $author) {
    //             $i++;
    //             echo $author;
    //             if(sizeof($element[2]) > $i) {
    //                 echo " | ";
    //             }
    //         }
    //         echo "<br>";
    //         echo "Genre: ". $element[3];
    //         echo "<br>";
    //         echo "<br>";
    //     }
    // }

?>
