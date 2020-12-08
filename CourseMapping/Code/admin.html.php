<!DOCTYPE html>
<html lang>
<head>
<meta name="author" content="Hyana Kang">
<!--The structure of this webpage is based on PieTown(midterm) 
written by Professor Streinu, and Yujun, Hyana's midterm projects-->
<title>Course Mapping</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel ="stylesheet" type ="text/css" href="css/homepageCSS.css"> 
<link rel ="stylesheet" type ="text/css" href="css/tab.css"> 
<link rel="stylesheet" type="text/css" href="css/messageBar.css">
<link rel="stylesheet" type="text/css" href="css/view.css">
<link rel="stylesheet" type="text/css" href="css/add.css">
</head>
<body>
<?php
   session_start();
       //if the admin is not logged-in, it'll be redirected to index.html.php automatically
   if ($_SESSION['username'] != '220'){ 
   echo '<script type = "text/javascript">
    window.location.href="index.html.php";
    </script>';
    }
?>

<?php include 'php/login/userinfo.php';?>

<div class = 'tab' id="tab">
    <button id = "logo">Course Mapping</button>
    <button class = "tablinks active" onclick= "openTab(event, 'Inst')">INSTRUCTION</button>
    <button class = "tablinks" onclick= "openTab(event, 'Courses')">COURSES</button>
    <button class = "tablinks" onclick= "openTab(event, 'Users')">USERS</button>
</div>

<article id = 'content'>
    <div id = 'Inst' class = 'tabcontent' style = 'display: block;'>
        <?php include "html/adminInst.html"?>
    </div>
    <div id = 'Courses' class = 'tabcontent' style = 'display: none;'>
        <?php include "html/viewCourses.html"?>
        <?php include "html/add.html"?>
    </div>
    <div id = 'Users' class = 'tabcontent' style = 'display: none;'>
        <?php include "html/users.html"?>
    </div>
</article>
<script src= "https://code.jquery.com/jquery-3.5.1.js"></script> 
<script type = "text/javascript" src = "js/script.js"></script>
<script type = "text/javascript" src= "js/viewCourses.js"></script>
<script type = "text/javascript" src= "js/viewMajors.js"></script>
<script type = "text/javascript" src= "js/viewUsers.js"></script>