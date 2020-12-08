<?php
function uploadItems($title, $image_url, $tags, $description, $price)
{
    include("db_connect.php");
    
    $sql = "REPLACE INTO store.items_for_sale(title, image_url, tags, description, seller, price)";
    $sql .= "   VALUES(?, ?, ?, ?, ?, ?);";
    
    $query = $conn->prepare($sql);
    $query->bind_param('sssssd', $it, $url, $t, $desc, $s, $p);
    
    $it   = $title;
    $url  = $image_url;
    $t    = $tags;
    $desc = $description;
    $s    = $_SESSION["username"];
    $p    = $price;
    
    $query->execute();
    
    return 1;
    
}

function changePassword($id, $pass1, $pass2)
{
    include("db_connect.php");
    
    if ($pass1 != $pass2) {
        return 0; // passwords don't match
        
    }
    
    $sql = "UPDATE user SET pass = ? WHERE id = ?;";
    
    $query = $conn->prepare($sql);
    $query->bind_param('si', $p, $i);
    
    $p = md5($pass1);
    $i = $id;
    
    $query->execute();
    
    return 1;
}

function changePicture($id, $imageURL)
{
    include("db_connect.php");
    
    $sql = "UPDATE user SET imageURL = ? WHERE id = ?;";
    
    $query = $conn->prepare($sql);
    $query->bind_param('si', $u, $i);
    
    $u = $imageURL;
    $i = $id;
    
    $query->execute();
    
    return 1;
    
}

function changeInfo($id, $info)
{
    include("db_connect.php");
    
    $sql = "UPDATE user SET info = ? WHERE id = ?;";
    
    $query = $conn->prepare($sql);
    $query->bind_param('si', $n, $i);
    
    $n = $info;
    $i = $id;
    
    $query->execute();
    
    return 1;
    
}

?>