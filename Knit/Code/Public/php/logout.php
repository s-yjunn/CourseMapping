<?php
    // This script logs a user out
    // @author Isabel

    // start the session
    session_start();
    // clear the username and admin fields
    unset($_SESSION["username"]);
    unset($_SESSION["admin"]);
?>