<!-- Author: Nukhbah Majid | Date: Nov 2020--> 
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
    <link rel="stylesheet" href="styles/stylesSignUp2.css">
    <title>Sign Up</title>
</head>
<body>
     <!-- Navigation bar-->
     <div class="w3-top">
        <div class="w3-bar w3-white w3-wide w3-padding w3-card">
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
    </div>
    <!-- End Nav bar -->
    <br>
    <br>
    <br>    
    <header>
        <div id="signUpButton"class="w3-center w3-display-middle w3-margin-top">
            <h1 class="w3-xxxlarge w3-text-white"><span  style="overflow:hidden">
                <img class="loginButton" src="../General/styles/logoSignUp.png" onclick="showSignUp()">  </span>
            </h1>
            <h1 onclick="showSignUp()" class="caption"> Sign up</h1>  
        </div>
    </header>

    <br>

    <div id="signUpForm" class="w3-center modal-content animate" style="display:none">
        <div class="imgcontainer">
                <span onclick="closeSignUp()" class="close"
                    title="Close Modal">&times;</span>
                <img src="../General/styles/logoSignUp.png" alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <form action="php/signup.inc.php" method="post">
                <label class="label" for="name"><b>Full Name</b></label>
                <input type="text" name="name" placeholder="Full Name" required>

                <label class="label" for="email"><b>Email</b></label>
                <input type="email" name="email" placeholder="Email" required>

                <label class="label" for="uname"><b>Username</b></label>
                <input type="text" name="uname" placeholder="Username" required>

                <label class="label" for="psw"><b>Password</b></label>
                <input type="password" name="pwd" placeholder="Password" required>
                <input type="password" name="pwdrepeat" placeholder="Re-type Password" required>
            
                <br><br>
                <button type="submit" name="submit" id="signupSubmit" class="register">Sign Up</button>
            </form>
        </div>
        

    </div>

    <div class="signupAck">
    
    
    </div>

    <script src="js/source.js"></script>
    <script src="js/scriptSignUp.js"></script>
</body>
</html>