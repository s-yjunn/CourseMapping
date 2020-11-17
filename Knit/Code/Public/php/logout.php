<?php
    // start the session
    session_start();
    // unset the username and admin fields
    unset($_SESSION["username"]);
    unset($_SESSION["admin"]);
?>