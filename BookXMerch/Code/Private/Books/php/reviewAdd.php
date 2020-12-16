<!-- Author: Nukhbah Majid--> 
<?php 

session_start();

$username = $_SESSION['username'];



$comment = $_REQUEST['comment'];
$rating = intval($_REQUEST['rating']);
$bookId = $_REQUEST['bookid']; 
$title = $_REQUEST['title']; 

echo $bookId . "<br>"; 
echo $title; 



$reviewsJSON = file_get_contents("../BookDefault/Reviews/allReviews.json");
$rows= json_decode($reviewsJSON, true);




// array to append to the pending requests
$arrReview = array(

    'bookId' => $bookId,
    'title' => $title, 
    'rating' => $rating,
    'comment' => $comment 
);

print_r($arrReview);



// see if the user already has some reviews
$hasReviews = FALSE; 

if($rows[$username]) {
    $hasReviews = TRUE;
    echo "<br>The user has previous reviews<br>";
    array_push($rows[$username], $arrReview);
} else {
    echo "<br>The user DOES NOT have previous reviews<br>";
    $arrEntry = array(
        $username => [$arrReview]
    );
    array_push($rows, $arrEntry);
}
$resJSON = json_encode($rows, JSON_PRETTY_PRINT);

if(file_put_contents("../BookDefault/Reviews/allReviews.json", $resJSON)) {
    echo "Success!"; 
    header("location: ../collection.php");
    //echo "<br>Success! The pending request has been added to the log"; 
    
} else {
    echo "failed to enter review";
    header("location: ../collection.php");
    //echo "error in processing pending requests"; 
    //header("location: ../../../profile.php");   
}
?>