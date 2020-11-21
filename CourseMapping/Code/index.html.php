<!DOCTYPE html>
<html lang>

<head>
    <title>Course Mapping</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/homepageCSS.css">
    <link rel="stylesheet" type="text/css" href="css/tab.css">
    <link rel="stylesheet" type="text/css" href="css/login_style.css">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <?php
    session_start();
    if ($_SESSION['username'] == 'admin'){ 
        echo '<script type = "text/javascript">
         window.location.href="admin.html.php";
         </script>';
         }
    ?>

    <h4>
        <?php include 'php/userinfo.php'; ?>
        
    </h4>

    <div class='tab' id="tab">
        <button id="logo">Course Mapping</button>
        <button class="tablinks active" onclick="openTab(event, 'Main')" <?php include 'php/logouttabs.php'; ?>>MAIN PAGE</button>
        <button class="tablinks" onclick="openTab(event, 'Saved')" <?php include 'php/logintabs.php'; ?>>SAVED</button>
        <button class="tablinks" onclick="newTab()" <?php include 'php/logintabs.php'; ?>>+</button>
        <button class = "tablinks" <?php include 'php/logouttabs.php';?>onclick= "openTab(event, 'Register')">REGISTER</button>
        <button class="tablinks" <?php include 'php/logouttabs.php'; ?>onclick="openTab(event, 'Login')">LOGIN</button>
    </div>

    <article id='content'>
        <div id='Main' class='tabcontent' style='display: block;'>
            <?php include "php/tab.html.php" ?>
        </div>
        <div id='Saved' class='tabcontent' style='display: none;'>
            <?php include "tabs/saved.html.php" ?>
        </div>
        <div id='Login' class='tabcontent' style='display: none;'>
            <?php include "tabs/login.html.php" ?>
        </div>
        <div id='Register' class='tabcontent' style='display: none;'>
            <?php include "tabs/register.html.php" ?>
        </div>
    </article>


    <script type = "text/javascript" src = "js/script.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/pathway.js"></script>
    <script src="js/savePathway.js"></script>
    <script src="js/logout.js"></script>
</body>

</html>