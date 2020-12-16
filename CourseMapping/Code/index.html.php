<!DOCTYPE html>
<html lang>

<head>
    <meta name="author" content="Hyana Kang">
    <!--The structure of this webpage is based on PieTown(midterm) 
written by Professor Streinu, and Yujun, Hyana's midterm projects-->
    <title>Course Mapping</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/homepageCSS.css">
    <link rel="stylesheet" type="text/css" href="css/tab.css">
    <link rel="stylesheet" type="text/css" href="css/loginStyle.css">
    <link rel="stylesheet" type="text/css" href="css/messageBar.css">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <?php
    session_start();
    //if the admin is logged-in, it'll be redirected to admin.html.php automatically
    if ($_SESSION['username'] == '220') {
        echo '<script type = "text/javascript">
         window.location.href="admin.html.php";
         </script>';
    }
    ?>

    <!--
        This message bar shows for a moment when "show" is added to the class name, and the innerHTML is changed by javascript code.
        It's like an alert box, but not annoying.
    -->
    <div id="messagebar" class=""></div>

    <?php include 'php/login/userinfo.php'; ?>

    <div class='tab' id="tab">
        <button id="logo">Course Mapping</button>
        <button class="tablinks active" onclick="openTab(event, 'Main')" <?php include 'php/login/logouttabs.php'; ?>>MAIN PAGE</button>
        <button class="tablinks" onclick="openTab(event, 'Instruction')" <?php include 'php/login/logintabs.php'; ?>>INSTRUCTION</button>
        <button class="tablinks" onclick="openTab(event, 'Saved')" <?php include 'php/login/logintabs.php'; ?>>SAVED</button>
        <button class="tablinks" onclick="newTab()" <?php include 'php/login/logintabs.php'; ?>>+</button>
        <button class="tablinks" <?php include 'php/login/logouttabs.php'; ?>onclick="document.getElementById('register').style.display='block'">REGISTER</button>
        <button class="tablinks" <?php include 'php/login/logouttabs.php'; ?>onclick="document.getElementById('login').style.display='block'">LOGIN</button>
    </div>

    <article id='content'>
        <div id='Main' class='tabcontent' style='display: block;'>
            <?php include "html/instruction.html" ?>
        </div>
        <div id='Saved' class='tabcontent' style='display: none;'>
            <?php include "php/saved.html.php" ?>
        </div>
        <div id='Instruction' class='tabcontent' style='display: none;'>
            <?php include "html/instruction.html" ?>
        </div>
        <?php include "html/register.html" ?>
        <?php include "html/login.html" ?>
        <?php include "html/removePopUp.html" ?>
    </article>


    <script type="text/javascript" src="js/script.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/jsonParser.js"></script>
    <script src="js/restorePathway.js"></script>
    <script src="js/pathwayFront.js"></script>
    <script src="js/pathway.js"></script>
    <script src="js/pathwayMeta.js"></script>
    <script src="js/messageBar.js"></script>
    <script src="js/save.js"></script>
    <script src="js/logout.js"></script>
    <script src="js/openSaved.js"></script>
</body>

</html>