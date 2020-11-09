<?php
session_start();
$_SESSION["username"] = "test";
$_SESSION["loggedin"] = false;
?>

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
<div class = 'tab' id="tab">
    <button id = "logo">Course Mapping</button>
    <button class = "tablinks" onclick= "openTab(event, 'Main')">MAIN PAGE</button>
    <button class = "tablinks" onclick= "openTab(event, 'Saved')">SAVED</button>
    <button class = "tablinks" onclick= "newTab()">+</button>
    <button class = "tablinks" style = "float:right;" onclick= "openTab(event, 'Login')">LOGIN</button>
</div>


<article id = 'content'>
    <div id = 'Main' class = 'tabcontent' style = 'display: block;'>
        <h2>Home Page</h2>
        <p>Directions to use this website</p>
        <p>Links to Course Catalog</p>
        <p>Directions to use this website</p>
        <!-- <//?php include "php/tab.html.php";?> -->
    </div>
    <div id = 'Saved' class = 'tabcontent' style = 'display: none;'>
        <h2>Saved</h2>
        <p>User: <?php echo $_SESSION["username"] ?></p>
        <p>Users' input will be automatically imported and able to be open</p>
    </div>
    <div id = 'Login' class = 'tabcontent' style = 'display: none;'>
        <h2>Login</h2>
        <div class="signin">
        <form class = "signin-content" action="php/login.php" method="post">
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>
            <button type="submit" class = "login">Login</button>
        </div>
        </form>
    </div>
</article>
<script type = "text/javascript" src = "js/script.js"></script>
</body>
</html>
