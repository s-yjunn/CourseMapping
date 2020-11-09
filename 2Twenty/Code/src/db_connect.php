<?php 
    // all of this removed from repo for security purposes:
    $server = "";
    $user = ""; 
    $password = "";
    $db = "";

    $conn = new mysqli($server, $user, $password, $db);
    if($conn -> connect_error) die("Failed to connect.");
?>