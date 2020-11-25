<?php 

if($_GET["argument"]=='logOut'){
    if(session_id() == '') {
        session_start();
    }
    session_unset();
    session_destroy();
    $loggedIn = false;
}
?>