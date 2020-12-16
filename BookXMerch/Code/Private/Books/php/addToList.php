<!-- Author: Imane Berrada | Date: Nov 28th, 2020--> 
<?php 

//Current user
session_start();
$loggedUser = $_SESSION["username"]; 

//Request the book ID 
$bookId = $_REQUEST['id'];

//users JSON file
$users = file_get_contents("../../Users/allUsers.JSON");
$usersArray = json_decode($users, true);

//books JSON file
$arrayOfBooks = file_get_contents("../allBooks.JSON");
$booksArray = json_decode($arrayOfBooks, true);
$newArray = array();

//create new array with book's title, author and genre
foreach ($booksArray as $key => $jsons) { 
    if($jsons["bookid"]==$bookId) {
        array_push($newArray,$jsons["bookid"],$jsons["title"],"Not-Started");

    break;
    }
}

foreach ($usersArray["users"] as $key => $jsons) { 
    if($jsons["username"]==$loggedUser) {
        $readingList= $usersArray["users"][$key]["readingList"];
        $userKey = $key;
    break;
  }
}

//Check if the book exists already
$bookExists=false;
foreach ($usersArray["users"][$userKey]["readingList"] as $element) {

    if ($newArray[0] == $element[0]) {
        echo "This book is already in your list!";
        $bookExists=true;
        break;
    }
}

if($bookExists==false) {
    echo "Added to your Reading List!";
    array_push($readingList,$newArray);
    $usersArray["users"][$userKey]["readingList"] = $readingList;

    $resJSON = json_encode($usersArray, JSON_PRETTY_PRINT);
    file_put_contents("../../Users/allUsers.JSON", $resJSON);
}

?>