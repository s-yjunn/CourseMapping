<?php

function register($uname,$upass)
{
    include ("db_connect.php");

    // search if account username is taken
    $sql = "SELECT COUNT(1) FROM `user` WHERE user= ? ;";

    $query = $conn->prepare($sql);
    $query->bind_param('s', $ue);

    $ue = $uname;
    $query->execute();

    $res = $query->get_result();

    while ($row = $res->fetch_all())
    {   
        // //if taken, return error 0
        if ($row[0][0]==1){
            
            return 0;
        }
    }

    //add user to database
    $sql = "INSERT INTO `user`(user,pass,mod_priv,admin_priv) VALUES(?, ?, 0, 0);";
    $query = $conn->prepare($sql);
    $query->bind_param('ss', $u, $p);

    $u = $uname;
    $p = md5($upass);

    $query->execute();

    return 1;
}

?>

