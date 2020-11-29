<?php
  session_start();
  if(isset($_SESSION["name"])) {
    $loggedIn = true;
    $loggedUser = $_SESSION["name"]; 
  }
//   unset($_SESSION["name"]); 
//   unset($_SESSION["psw"]); 

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

            <div class='w3-right w3-hide-medium w3-hide-small'>
                <a href='#aboutUs' class='w3-bar-item buttonNavBar'>About us</a>
            </div>
            
            
            <div class='w3-right w3-hide-medium w3-hide-small'>
                <a href='Merch/collection.php' class='w3-bar-item buttonNavBar'>Merch</a>
            </div>

            <?php if( $loggedIn == false) {
                echo "<div class='w3-right w3-hide-small'>
                        <a href='SignUp/signup.php' class='w3-bar-item buttonNavBar'>Sign up</a>
                     </div>

                    <div class='w3-right w3-hide-small'>
                        <a href='Login/login.php' class='w3-bar-item buttonNavBar'>Login</a>
                    </div>";
            } else {
                echo "<div class='w3-hide-small'>
                        <a id='logoutButton2' class='w3-bar-item buttonNavBar' style='cursor:pointer'> ". $_SESSION["name"].": Log Out</a>
                    </div>";
            }
            
            ?>
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

                    <div id="comics"> <button class="imgButton"><img class="imageClass"
                                src="../Private/Books/Images/comics.png" alt="bm"></button></div>
                    <div id="children"> <button class="imgButton"> <img
                                class="imageClass" src="../Private/Books/Images/children.png" alt="bm"></button></div>
                    <div id="sci-fi"> <button class="imgButton"><img class="imageClass"
                                src="../Private/Books/Images/scifi.png" alt="bm"></button></div>
                    <div id="fiction"> <button class="imgButton"><img
                                class="imageClass" src="../Private/Books/Images/fiction.png" alt="bm"></button></div>
                    <div id="nonfiction"> <button class="imgButton"><img
                                class="imageClass" src="../Private/Books/Images/nonfiction.png" alt="bm"></button></div>
                    <div id="debut-novel"> <button class="imgButton"><img
                                class="imageClass" src="../Private/Books/Images/debutnovel.png" alt="bm"></button></div>
                    <div id="horror"> <button class="imgButton"><img class="imageClass"
                                src="../Private/Books/Images/horror.png" alt="bm"></button></div>
                    <div id="romance"> <button class="imgButton"><img
                                class="imageClass" src="../Private/Books/Images/romance.png" alt="bm"></button></div>

                </div>
            </div>
        </div>

    </div>

    <div id="overlayLogin" onclick="off()" style="display: none">
               
        <?php 
            if($loggedIn == true) {
                echo "<div class='alert'> <a style='text-decoration:none' href='../Private/Books/collection.php'> <h2> Access our collection here <h2> </a> </div>";
            } else {          
                echo "<div class='alert'> <a style='text-decoration:none' href='Login/login.php'> <h2> Please log in first <h2> </div>";
            }
        ?>
    </div> 

    <div class="tabcontent">
        <div class="card2 border">
            <h2 class="colortheme" style="color:white">Our Merch</h2>
            <div class="wrapper">

                <div id="Colthing"> <a class="imageClass" href="Merch/collection.php"><img class="imageClass"  src="Merch/Images/clothing.png" alt="bm"></button></a></div>
                <div id="Other"> <a class="imageClass" href="Merch/collection.php"><img class="imageClass" src="Merch/Images/collectibles.png" alt="bm"></a></div>
                <div id="Collectibles"> <a class="imageClass" href="Merch/collection.php"> <img class="imageClass" src="Merch/Images/other.png" alt="bm"></a></div>
                
            </div>
        </div>
    </div>
    <div class="tabcontent">
        <div class="card border">
            <h2 id="aboutUs" class="colortheme">About Us</h2>
        </div>
    </div>


    <!-- <div id="booksOfMonth">
            <br>
            <br>
            <dl class="bookshelf wrapper" style="background-image: none">
                <dt class="bookOfMonth1" ><span> The Space Between Worlds</span></dt>
            </dl>
    </div> -->

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="General/js/loginDirect.js"></script>     
    <script src="General/js/logOut-main.js"></script>  
</body>

</html>