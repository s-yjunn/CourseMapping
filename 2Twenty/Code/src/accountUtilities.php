<?php

function uploadItems($title, $image_url, $tags, $description, $price) 
{
    include ("db_connect.php");

    $sql = "REPLACE INTO store.items_for_sale(title, image_url, tags, description, seller, price)";
    $sql .= "   VALUES(?, ?, ?, ?, ?, ?);";



    $query = $conn->prepare($sql);
    $query->bind_param('sssssd', $it, $url, $t, $desc, $s, $p);

    $it = $title;
    $url = $image_url;
    $t = $tags;
    $desc = $description;
    $s = $_SESSION["username"];
    $p = $price;

    $query->execute();

    return 1;

}


function changePassword($id,$pass1,$pass2)
{
    include ("db_connect.php");


    if ($pass1 != $pass2){
        return 0; // passwords don't match
    }

    // set new password
    $sql = "UPDATE user SET pass = ? WHERE id = ?;";

    $query = $conn->prepare($sql);
    $query->bind_param('si', $p, $i);

    $p = md5($pass1);
    $i = $id;

    $query->execute();

    return 1;
}


function changePicture($imageURL)
{
    include ("db_connect.php");


    // set new imageURL
    $sql = "UPDATE user SET imageURL = ? WHERE user = ?;";

    $query = $conn->prepare($sql);
    $query->bind_param('ss', $p, $u);

    $p = $imageURL;
    $u = $_SESSION["username"];

    $query->execute();

    return 1;

}


function changeInfo($newInfo)
{
    include ("db_connect.php");

    // search by tags, title, description, seller
    // sorted by relevance to title of item
    $sql = "UPDATE user SET info = ? WHERE user = ?;";

    $query = $conn->prepare($sql);
    $query->bind_param('ss', $i, $u);

    $i = $newInfo;
    $u = $_SESSION["username"];

    $query->execute();

    return 1;

    
}

?>
