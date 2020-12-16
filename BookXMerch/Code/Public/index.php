<!-- Author: Imane (with modifications from Nukhbah and Mariem)| Date: November-December 2020--> 
<?php
  session_start();
  if(isset($_SESSION["name"])) {
    $loggedIn = true;
    $loggedUser = $_SESSION["name"]; 
    $type = $_SESSION["type"]; 
  }


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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

<body>
    <!-- Navigation bar-->
    <nav class="w3-top" id="head-navbar">
        <div class="w3-bar w3-white w3-wide w3-padding 3w-card">
            <a href="../Public/index.php" class="w3-bar-item w3-button"><b>Bookstore</b>x<b>Merch</b></a>
            <!-- Float links to the right. Hide them on small screens -->

            <?php if($type=="admin") {

            echo "<div class='w3-hide-medium w3-hide-small'>
                        <a href='../Private/Admin/admin.php' class='w3-bar-item buttonNavBar'>Admin</a>
                </div>";
            }?>
            <?php if( $loggedIn == false) {
                echo "<div class='w3-right w3-hide-small'>
                        <a href='SignUp/signup.php' class='w3-bar-item buttonNavBar'>Sign up</a>
                     </div>

                    <div class='w3-right w3-hide-small'>
                        <a href='Login/login.php' class='w3-bar-item buttonNavBar'>Login</a>
                    </div>";
            } else {
                echo "
                    <div class='w3-hide-medium w3-hide-small'>
                        <a href='Profile/profile.php' class='w3-bar-item buttonNavBar'>Profile</a>
                    </div> 
                    <div class='w3-hide-medium w3-hide-small'>
                        <a href='../Private/Books/collection.php' class='w3-bar-item buttonNavBar'><i class='fas fa-book'></i>Collections</a>
                    </div>";

                if($type=="admin") {
                    echo "<div class='w3-right w3-hide-medium w3-hide-small'>
                            <a id='logoutButton2' class='w3-bar-item buttonNavBar' style='cursor:pointer'> Log Out</a>
                        </div>";
                } else {
                    echo "<div class='w3-right w3-hide-medium w3-hide-small'>
                        <a id='logoutButton2' class='w3-bar-item buttonNavBar' style='cursor:pointer'> ". $_SESSION["name"].": Log Out</a>
                    </div>";
                }
                
            }
            
            ?>
            <div class='w3-hide-medium w3-hide-small'>
                <a href='General/instructions.php' class='w3-bar-item buttonNavBar'>Instructions</a>
            </div>
            
            
            <div class='w3-hide-medium w3-hide-small'>
                <a href='Merch/collection.php' class='w3-bar-item buttonNavBar'>Merch</a>
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
        <div class="card2 border">

            <h2 class="colortheme" style="color:white">Our Collection</h2>
        
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
        <div class="card border">
            <h2 class="colortheme">Our Merch</h2>
            <div class="wrapper2">

                <div id="Colthing"> <a href="Merch/collection.php"><img class="imageClass" src="Merch/Images/birthdayCard.png" alt="bm"></button></a></div>
                <div id="Other"> <a href="Merch/collection.php"><img class="imageClass" src="Merch/Images/calendar.png" alt="bm"></a></div>
                <div id="Collectibles"> <a href="Merch/collection.php"> <img class="imageClass" src="Merch/Images/notebook.png" alt="bm" ></a></div>
                
            </div>
        </div>
    </div>
    <div class="tabcontent">
        <div class="card2 border" >
            <h2 id="aboutUs" class="colortheme" style="color:white">About Us</h2>
            <div class="w3-center">
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                        <img src="General/styles/Imane.png" alt="Avatar" style="width:300px;height:300px;">
                        </div>
                        <div class="flip-card-back">
                        <h1>Imane Berrada</h1> 
                        <p>Smith College '21</p> 
                        <p>Economics and CS</p>
                        </div>
                    </div>
                </div>
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                        <img src="General/styles/Nukhbah.png" alt="Avatar" style="width:300px;height:300px;">
                        </div>
                        <div class="flip-card-back">
                        <h1>Nukhbah Majid</h1> 
                        <p>Smith College '21</p> 
                        <p>Computer Science</p>
                        </div>
                    </div>
                </div>
                <div class="flip-card">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                        <img src="General/styles/Mariem.png" alt="Avatar" style="width:300px;height:300px;">
                        </div>
                        <div class="flip-card-back">
                        <h1>Mariem Snoussi</h1> 
                        <p>Smith College '23</p> 
                        <p>Computer Science</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="General/js/loginDirect.js"></script>     
    <script src="General/js/logOut-main.js"></script>  
</body>

</html>