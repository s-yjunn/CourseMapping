<?php
  session_start();
  unset($_SESSION["name"]); 

?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lobster&family=Playfair+Display&display=swap">
    <link
        href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Assistant:wght@300&family=Indie+Flower&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="General/styles/welcomeStyles.css" id="styles">
    <link rel="stylesheet" href="../Private/Books/CSS/bookshelfStyles.css">
</head>

<body>
    <!-- Navigation bar-->
    <nav class="w3-top" id="head-navbar">
        <div class="w3-bar w3-white w3-wide w3-padding 3w-card">
            <a href="../Public/index.php" class="w3-bar-item w3-button"><b>Bookstore</b>x<b>Merch</b></a>
            <!-- Float links to the right. Hide them on small screens -->


            <div class="w3-right w3-hide-medium w3-hide-small">
                <a href="#" class="w3-bar-item w3-button">About us</a>
            </div>

            <div class="w3-right w3-hide-medium w3-hide-small">
                <a href="Merch/collection.php" class="w3-bar-item w3-button">Merch</a>
            </div>

            <div class="w3-right w3-hide-small">
                <a href="SignUp/signup.php" class="w3-bar-item w3-button">Sign up</a>
            </div>

            <div class="w3-right w3-hide-small">
                <a href="Login/login.php" class="w3-bar-item w3-button">Login</a>
            </div>
        </div>
    </nav>

    <div id="home" style="max-width:1500px">
        <br> <br>
        <img class="w3-image w3-center" src="../Public/General/styles/welcome.png" alt="welcome" width="900"
            height="700">
    </div>
    <br> <br>
    <div class="tabcontent">
        <div class="card border">

            <h2 class="colortheme">Our Collection</h2>
        
            <div id="collectionId">
                <div class="wrapper">

                    <div id="comics"> <button class="imgButton" onclick="loginDirect('comics')"><img class="imageClass"
                                src="../Private/Books/Images/comics.png" alt="bm"></button></div>
                    <div id="children"> <button class="imgButton" onclick="loginDirect('children')"> <img
                                class="imageClass" src="../Private/Books/Images/children.png" alt="bm"></button></div>
                    <div id="sci-fi"> <button class="imgButton" onclick="loginDirect('sci-fi')"><img class="imageClass"
                                src="../Private/Books/Images/scifi.png" alt="bm"></button></div>
                    <div id="fiction"> <button class="imgButton" onclick="loginDirect('fiction')"><img
                                class="imageClass" src="../Private/Books/Images/fiction.png" alt="bm"></button></div>
                    <div id="nonfiction"> <button class="imgButton" onclick="loginDirect('nonfiction')"><img
                                class="imageClass" src="../Private/Books/Images/nonfiction.png" alt="bm"></button></div>
                    <div id="debut-novel"> <button class="imgButton" onclick="loginDirect('debut-novel')"><img
                                class="imageClass" src="../Private/Books/Images/debutnovel.png" alt="bm"></button></div>
                    <div id="horror"> <button class="imgButton" onclick="loginDirect('horror')"><img class="imageClass"
                                src="../Private/Books/Images/horror.png" alt="bm"></button></div>
                    <div id="romance"> <button class="imgButton" onclick="loginDirect('romance')"><img
                                class="imageClass" src="../Private/Books/Images/romance.png" alt="bm"></button></div>

                </div>
            </div>
        </div>

    </div>
    <div id="pleaseLogin" class="w3-center modal-content animate" style="display:none">
        <div class="imgcontainer">
                <span class="close" id="closeModal" title="Close Modal">&times;</span>
                <a href="Login/login.php"> <h2> Please log in first <h2> </a>
        </div>

    </div>
    <!-- <div class="w3-center" id="pleaseLogin" style="display:none"> 
        <a href="Login/login.php">
            <h2> Please log in first</h2>
        </a>
    </div> -->


    <!-- <div id="booksOfMonth">
            <br>
            <br>
            <dl class="bookshelf wrapper" style="background-image: none">
                <dt class="bookOfMonth1" ><span> The Space Between Worlds</span></dt>
            </dl>
    </div> -->

    <script src="../Public/General/js/source.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../Public/General/js/loginDirect.js"></script>

</body>

</html>