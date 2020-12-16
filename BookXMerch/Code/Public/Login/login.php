<!-- Authors: Nukhbah Majid (back-end) and Imane Berrada (front-end) | Date: Nov 19, 2020--> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lobster&family=Playfair+Display&display=swap">
    <link
        href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Assistant:wght@300&family=Indie+Flower&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="styles/stylesLogin2.css">
    <title>Login</title>
</head>

<body>
    <!-- Navigation bar-->
    <nav class="w3-top" id="head-navbar" >
        <div class="w3-bar w3-white w3-wide w3-padding 3w-card">
            <a href="../index.php" class="w3-bar-item w3-button"><b>Bookstore</b>x<b>Merch</b></a>
            <!-- Float links to the right. Hide them on small screens -->

            
            <div class="w3-right w3-hide-medium w3-hide-small">
                <a href="#" class="w3-bar-item buttonNavBar">About us</a>
            </div>

            <div class="w3-right w3-hide-medium w3-hide-small">
                <a href="../Merch/collection.php" class="w3-bar-item buttonNavBar">Merch</a>
            </div>

            <div class="w3-right w3-hide-small">
                <a href="../SignUp/signup.php" class="w3-bar-item buttonNavBar">Sign up</a>
            </div>

            <div class="w3-right w3-hide-small">
                <a href="../Login/login.php" class="w3-bar-item buttonNavBar">Login</a>
            </div>
        </div>
    </nav>
    <!-- End Nav bar -->
    <br>
    <br>
    <br>    
    <header>
        <div id="loginButton"class="w3-center w3-display-middle w3-margin-top">
            <h1 class="w3-xxxlarge w3-text-white"><span  style="overflow:hidden">
                <img class="loginButton" src="../General/styles/logoLogin.png" onclick="showLogin()">  </span>
            </h1>
            <h1 onclick="showLogin()" class="caption"> Log in</h1>  
        </div>
    </header>

    <br>
    <!-- LOGIN FORM-->
    <div id="loginForm" class="w3-center modal-content animate" style="display:none">
        <div class="imgcontainer">
                <span onclick="closeLogin()" class="close"
                    title="Close Modal">&times;</span>
                <img src="../General/styles/logoLogin.png" alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <form action="php/login.inc.php" method="post">
                <label class="label" for="email"><b>Email</b></label>
                <input type="email" name="email" placeholder="Email" required>
                <label class="label" for="psw"><b>Password</b></label>
                <input type="password" name="pwd" placeholder="Password" required>
                <br><br>
                <button type="submit" name="submit" id="loginSubmit" class="register">Log In</button>
            </form>
        </div>
        

    </div>

   <div class="loginAck">
   
   </div>
   

   <script src="js/source.js"></script>
   <script src="js/scriptLogin.js"></script>
</body>
</html>