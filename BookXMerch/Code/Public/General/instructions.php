<?php
  session_start();
  if(isset($_SESSION["name"])) {
    $loggedIn = true;
    $loggedUser = $_SESSION["name"]; 
    $type = $_SESSION["type"]; 
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
    <link rel="stylesheet" href="styles/welcomeStyles.css" id="styles">
    <link rel="stylesheet" href="../../Private/Books/CSS/bookshelfStyles.css">
</head>

<body>
    <!-- Navigation bar-->
    <nav class="w3-top" id="head-navbar">
        <div class="w3-bar w3-white w3-wide w3-padding 3w-card">
            <a href="../Public/index.php" class="w3-bar-item w3-button"><b>Bookstore</b>x<b>Merch</b></a>
            <!-- Float links to the right. Hide them on small screens -->

            <?php if($type=="admin") {

            echo "<div class='w3-hide-medium w3-hide-small'>
                        <a href='../Private/Admin/admin.php' class='w3-bar-item buttonNavBar'>Admin page</a>
                </div>";
            }?>
            <?php if( $loggedIn == false) {
                echo "<div class='w3-right w3-hide-small'>
                        <a href='../SignUp/signup.php' class='w3-bar-item buttonNavBar'>Sign up</a>
                     </div>

                    <div class='w3-right w3-hide-small'>
                        <a href='../Login/login.php' class='w3-bar-item buttonNavBar'>Login</a>
                    </div>";
            } else {
                echo "<div class='w3-hide-medium w3-hide-small'>
                        <a href='../Profile/profile.php' class='w3-bar-item buttonNavBar'>Profile</a>
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
                <a href='../index.php' class='w3-bar-item buttonNavBar'>About us</a>
            </div>
            <div class='w3-hide-medium w3-hide-small'>
                <a href='#instructions' class='w3-bar-item buttonNavBar'>Instructions</a>
            </div>
            
            
            <div class='w3-hide-medium w3-hide-small'>
                <a href='../Merch/collection.php' class='w3-bar-item buttonNavBar'>Merch</a>
            </div>
        </div>
    </nav>

    <div id="home" style="max-width:1500px">
        <br> <br>
        <img class="w3-image w3-center" src="styles/welcome.png" alt="welcome" width="900"
            height="700">
    </div>
    <br> <br>
    <
    <div id="overlayLogin" onclick="off()" style="display: none">
               
        <?php 
            if($loggedIn == true) {
                echo "<div class='alert'> <a style='text-decoration:none' href='../../Private/Books/collection.php'> <h2> Access our collection here <h2> </a> </div>";
            } else {          
                echo "<div class='alert'> <a style='text-decoration:none' href='../Login/login.php'> <h2> Please log in first <h2> </div>";
            }
        ?>
    </div>
    <div class="tabcontent">
        <div class="card border">
            <h2 id="instructions" class="colortheme">Instructions</h2>
			Welcome, Dear User. Please follow these steps to make the most of your experience at BookstoreXMerch
			<ol>
				<li>
					Use Sign In to use your account, or Sign Up to make a new one
				</li>
				<li>
					View your profile to check your reading list, upload books, and view your stats. Uploaded books will be pending approval by admins.
				</li>
				<li>
					Check our Merch store with cool themed items for your everyday use
				</li>
				<li>
					Go to book collection from the About Us page to browse through our collection. You can browse by category. By clicking on a book you like you will be able to see details about it and add it to you Reading List. You will also be able to write a review for it once you read it.
				</li>
				<li>
					Go to Community Posts, our very cool forum, in order to share your passion about Books with like-minded users. You can ask for recommendations, reviews and resources to help you through your reading journey.
				</li>
				<li>
					Once you're done with BookstoreXMerch for the day, you can use the log out button to say goodbye ! We hope to see you soon :) 
				</li>
			</ol>
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
    <script src="js/loginDirect.js"></script>     
    <script src="js/logOut-main.js"></script>  
</body>
