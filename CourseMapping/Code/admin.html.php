<!DOCTYPE html>
<html lang>
<head>
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
   if ($_SESSION['username'] != 'admin'){ 
   echo '<script type = "text/javascript">
    window.location.href="index.html.php";
    </script>';
    }
?>

<?php include 'php/userinfo.php';?>

<div class = 'tab' id="tab">
    <button id = "logo">Course Mapping</button>
    <button class = "tablinks active" onclick= "openTab(event, 'Courses')">COURSES</button>
</div>

<article id = 'content'>
    <div id = 'Courses' class = 'tabcontent' style = 'display: block;'>
        <?php include "html/viewCourses.html"?>
        <?php include "html/add.html"?>
    </div>
</article>
<script src= "https://code.jquery.com/jquery-3.5.1.js"></script> 
<script type = "text/javascript" src = "js/script.js"></script>
<script type = "text/javascript" src= "js/viewCourses.js"></script>
<script type = "text/javascript" src= "js/viewMajors.js"></script>