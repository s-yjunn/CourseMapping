<!-- Author: Imane Berrada | Date: Dec 7th, 2020--> 
<?php 
    session_start();
    $loggedUser = $_SESSION["username"]; 

    $fn  = $_POST['fn'];
    $toAdd  = $_POST['toAdd'];

    //get pending requests
    $testJSON = file_get_contents("../../Books/BookDefault/Pending/allPendingBooks.json");
    $rowsAll= json_decode($testJSON, true);
    $rows = $rowsAll['requests'];
    $new = [];
    $idToAdd = $toAdd[0]; 
    $user = $toAdd[1]; 

    
    if(sizeof($fn)==0) {
        $new=[];
        
        $i=0;
        foreach ($rows as $key => $jsons) { 
            $i++;
            $t = "t".$i;
            if($idToAdd==$t) {
                $bookToUpload = $jsons;
            }
        } 
    }  else {
        $i=0;
        foreach ($rows as $key => $jsons) { 
            $i++;
            $t = "t".$i;

            if(!($toAdd[0]==$t)) {
                array_push($new,$jsons);  
                
            } else {
                $bookToUpload = $jsons;
            }
        }
    }

    //users JSON file
    $users = file_get_contents("../../Users/allUsers.JSON");
    $usersArray = json_decode($users, true);

    //books JSON file
    $arrayOfBooks = file_get_contents("../../Books/allBooks.JSON");
    $booksArray = json_decode($arrayOfBooks, true);

    $j=0;
    foreach($booksArray as $book){
        $j++;
        if($j==sizeof($booksArray)) {
            $lastId=$book["bookid"];
        }
    }
    //push the new book onto booksArray
    $newId = strval($lastId+1);
    $arr_row = array(
        "bookid" => $newId, 
        "genre" => $bookToUpload["genre"],
        'title' => $bookToUpload["title"], 
        'author' => $bookToUpload["author"],
        'illustrator' => $bookToUpload["illustrator"],
        'description' => $bookToUpload["desc"],
        "url" => $bookToUpload["url"],
        "image_url"  => "",
        "rating" => "5",
        "reviews"=> []
    );
    array_push($booksArray,$arr_row);
    $bookJSON = json_encode($booksArray, JSON_PRETTY_PRINT);
    file_put_contents("../../Books/allBooks.JSON", $bookJSON);

    //Get the user's uploaded books
    foreach ($usersArray["users"] as $key2 => $jsons2) { 
        if($jsons2["username"]==$user) {
            $uploadedBooks= $usersArray["users"][$key2]["myBooks"];
            if (is_null($uploadedBooks)) {
                $uploadedBooks=[];
            }
            $userKey = $key2;
        break;
        }
    }
    array_push($uploadedBooks,$arr_row);
    $usersArray["users"][$userKey]["myBooks"] = $uploadedBooks;

    $resJSON = json_encode($usersArray, JSON_PRETTY_PRINT);
    file_put_contents("../../Users/allUsers.JSON", $resJSON);

    //update pending requests
    $rows=$new;
    $rowsAll["requests"]=$new;
    $resJSON = json_encode($rowsAll, JSON_PRETTY_PRINT);
    file_put_contents("../../Books/BookDefault/Pending/allPendingBooks.json", $resJSON);
?>