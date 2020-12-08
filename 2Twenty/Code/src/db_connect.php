<?php
$server   = "108.53.75.168:3316";
$user     = "user";
$password = "password";
$db       = "store";
$conn     = new mysqli($server, $user, $password, $db);
if ($conn->connect_error)
    die("Failed to connect.");
?>