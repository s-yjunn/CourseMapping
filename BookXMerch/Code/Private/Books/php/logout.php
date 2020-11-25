<?php 

if($_GET["argument"]=='logOut'){
    if(session_id() == '') {
        session_start();
    }
    session_unset();
    session_destroy();
    $loggedIn = false;
}

    // session_start();
    // unset($_SESSION["name"]); 
    // unset($_SESSION["psw"]); 
    // session_destroy();
?>