<?php
function changePassword($id,$pass1,$pass2)
{
    include ("db_connect.php");

    if ($pass1 != $pass2){
        return 0; // passwords don't match
    }

    // search by tags, title, description, seller
    // sorted by relevance to title of item
    $sql = "UPDATE user SET pass = ? WHERE id = ?;";

    $query = $conn->prepare($sql);
    $query->bind_param('si', $p, $i);

    $p = $pass1;
    $i = $id;

    $query->execute();

    return 1;
}


function changePicture($id,$imageURL)
{
    include ("db_connect.php");

    // search by tags, title, description, seller
    // sorted by relevance to title of item
    $sql = "UPDATE user SET imageURL = ? WHERE id = ?;";

    $query = $conn->prepare($sql);
    $query->bind_param('si', $u, $i);

    $u = $imageURL;
    $i = $id;

    $query->execute();

    return 1;

    
}


function changeInfo($id,$info)
{
    include ("db_connect.php");

    // search by tags, title, description, seller
    // sorted by relevance to title of item
    $sql = "UPDATE user SET info = ? WHERE id = ?;";

    $query = $conn->prepare($sql);
    $query->bind_param('si', $n, $i);

    $n = $info;
    $i = $id;

    $query->execute();

    return 1;

    
}

?>
