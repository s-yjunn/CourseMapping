<?php

function register($uname,$upass)
{
    include ("db_connect.php");

    // search if account username is taken
    //if taken, return error

    //add user to database
    //idk what bind_param() is 
    $sql = "INSERT INTO `user`(user,pass,mod_priv,admin_priv) VALUES(?, ?, 0, 0);";
    $query = $conn->prepare($sql);
    $query->bind_param('ss', $u, $p);

    $u = $uname;
    $p = md5($upass);

    $query->execute();

    return 1;
}

?>

