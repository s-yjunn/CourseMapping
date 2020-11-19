<!DOCTYPE html>
<html lang>
<head>
<title>Course Mapping</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel ="stylesheet" type ="text/css" href="css/homepageCSS.css"> 
<link rel ="stylesheet" type ="text/css" href="css/tab.css"> 
<link rel ="stylesheet" type ="text/css" href="css/login_style.css"> 
</head>
<body>
<?php
   session_start();
?>

<h4>
<?php include 'php/userinfo.php';?>
</h4>

<div class = 'tab' id="tab">
    <button id = "logo">Course Mapping</button>
    <button class = "tablinks active" <?php include 'php/admintab.php';?> onclick= "openTab(event, 'Add')">ADMIN</button>
    <button class = "tablinks" <?php include 'php/admintab.php';?> onclick= "openTab(event, 'View')">VIEW</button>
</div>

<article id = 'content'>
    <div id = 'Add' class = 'tabcontent' style = 'display: block;'>
        <?php include "tabs/add.html.php"?>
    </div>
    <div id = 'View' class = 'tabcontent' style = 'display: none;'>
        <?php include "tabs/view.html.php"?>
    </div>
</article>

<script type = "text/javascript" src = "js/script.js"></script>