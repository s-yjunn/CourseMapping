<?php

$uname = $_POST['uname'];
$upass = $_POST['upass'];

function register($uname,$upass)
{
    include ("db_connect.php");

    // search if account username is taken
    //if taken, return error

    //add user to database
    //idk what bind_param() is 
    $sql = "INSERT INTO `user` VALUES($uname, md5($upass),0,0);";
    $query = $conn->prepare($sql);

    $query->execute();


}




register($uname,$upass);
?>

