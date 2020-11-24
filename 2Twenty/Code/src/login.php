<?php

function handle_login($uname,$upass)
{
    include ("db_connect.php");

    //i attempted to mirror the register code

    $sql = "SELECT COUNT(1) FROM `user` WHERE user = ? AND pass = ? ;";
    $query = $conn->prepare($sql);
    $query->bind_param('ss', $u, $p);
    $u = $uname;
    $p = md5($upass);

    $query->execute(); 

    $r = $query->get_result();
    
    while ($row = $r->fetch_all()){
        if ($row[0][0] == 1) {
            return 1;
        }
    }


    
}

?>