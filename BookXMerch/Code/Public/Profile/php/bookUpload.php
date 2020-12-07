<?php 

session_start();

$username = $_SESSION['username'];
echo "debug comment<br>";
 


$genre = $_POST['genre'];
$title = $_POST['title']; 
$authors = $_POST['author']; 
$illustrators = $_POST['illustrator']; 
$summary = $_POST['summary']; 
$bookURL = $_POST['url']; 


$pendingJSON = file_get_contents("../../../Private/Books/BookDefault/Pending/allPendingBooks.json");
$rows= json_decode($pendingJSON, true);

echo "<br>debug comment 2<br>"; 

// Check if there are more than one author and more than one illustrator. 

$arrAuthors = explode(",", $authors);
$arrIllustrators = explode(",", $illustrators);


// array to append to the pending requests
$arrReq = array(

    'reqUsername' => $username, 
    'genre' => $genre,
    'title' => $title, 
    'author' => $arrAuthors,
    'illustrator' => $arrIllustrators,
    'desc' => $summary, 
    'url' => $bookURL, 
    'image_url' => "", 
    'rating' => "5",
    'reviews' => [] 
);

echo "debug comment: " . $arrReq; 


array_push($rows['requests'], $arrReq);
$resJSON = json_encode($rows, JSON_PRETTY_PRINT);
if(file_put_contents("../../../Private/Books/BookDefault/Pending/allPendingBooks.json", $resJSON)) {
    echo "Success! The pending request has been added to the log"; 
    
} else {
    header("location: ../../../profile.php");
    echo "error in processing pending requests"; 
}
?>