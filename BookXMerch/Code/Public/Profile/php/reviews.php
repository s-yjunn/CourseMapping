<!-- Author: Nukhbah Majid | Date: Dec 2020--> 
<?php 

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
?>
