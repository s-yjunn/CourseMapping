<?php
session_start();
$_SESSION["username"] = "test";
$_SESSION["loggedin"] = false;
?>

<!DOCTYPE html>
<html lang>
<head>
<title>Course Mapping</title>
<p>User: <?php echo $_SESSION["username"] ?></p>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel ="stylesheet" type ="text/css" href="css/homepageCSS.css"> 
<link rel ="stylesheet" type ="text/css" href="css/tab.css"> 
</head>
<body>
<header>
    <h2>Course Mapping</h2>
</header>

<div class = 'tab'>
    <button class = "tablinks" onclick= "openTab(event, 'Main')">Main Page</button>
    <button class = "tablinks" onclick= "openTab(event, 'Saved')">Saved</button>
    <button class = "tablinks" onclick= "openTab(event, '+')">+</button>
    <button class = "tablinks" style = "float:right;" onclick= "openTab(event, 'Login')">Login</button>
</div>
<article>
    <div id = 'Main' class = 'tabcontent' style = 'display: block;'>
        <h3>Home Page</h3>
        <p>Directions to use this website</p>
        <p>Links to Course Catalog</p>
        <p>Directions to use this website</p>
        <!-- <//?php include "php/tab.html.php";?> -->
    </div>
    <div id = 'Saved' class = 'tabcontent' style = 'display: none;'>
        <h3>Saved</h3>
        <p>Users' input will be automatically imported and able to be open</p>
    </div>
    <div id = '+' class = 'tabcontent' style = 'display: none;'>
        <h3>Untitled</h3>
        <p>User can add a new tab and name the title</p>
    </div>
    <div id = 'Login' class = 'tabcontent' style = 'display: none;'>
        <h3>Login</h3>
        <form action="php/login.php" method="post">
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>
        <button type="submit">Login</button>
    </div>
    </div>
</article>
<script type = "text/javascript" src = "js/script.js"></script>
</body>
</html>
