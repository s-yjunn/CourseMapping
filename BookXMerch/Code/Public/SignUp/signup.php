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
    <link rel="stylesheet" href="../General/styles/styles.css">
    <title>Sign Up</title>
</head>
<body>
     <!-- Navigation bar-->
     <div class="w3-top">
        <div class="w3-bar w3-white w3-wide w3-padding w3-card">
            <a href="../index.php" class="w3-bar-item w3-button"><b>Bookstore</b>x<b>Merch</b></a>
            <!-- Float links to the right. Hide them on small screens -->

            <div class="w3-right w3-hide-small">
                <a href="#" class="w3-bar-item w3-button">About us</a>
            </div>

            <div class="w3-right w3-hide-small">
                <a href="../Merch/collection.php" class="w3-bar-item w3-button">Merch</a>
            </div>

            <div class="w3-right w3-hide-small">
                <a href="#" class="w3-bar-item w3-button">Community</a>
            </div>

            <div class="w3-right w3-hide-small">
                <a href="#" class="w3-bar-item w3-button">Profile</a>
            </div>

            <div class="w3-right w3-hide-small">
                <a href="../SignUp/signup.php" class="w3-bar-item w3-button">Sign up</a>
            </div>

            <div class="w3-right w3-hide-small">
                <a href="../Login/login.php" class="w3-bar-item w3-button">Login</a>
            </div>
        </div>
    </div>
    <!-- End Nav bar -->

<br>

<br>

<br>
    <div class="w3-center">
        <h1>SIGN UP PAGE</h1>
    </div>

    <header class="w3-display-container w3-content w3-wide" style="max-width:1500px; background-color: white;"
        id="home">
        <img class="w3-image" src="../General/styles/login.png" alt="signup" width="1500" height="800">
        <div class="w3-display-middle w3-margin-top w3-center">
            <h1 class="w3-xxlarge w3-text-white"><span class="w3-black w3-opacity-min" style="overflow:hidden"><b>
                    </b></span>
            </h1>
        </div>
    </header>

<br>
<div class="w3-center">
    <div class="signup-form-form">
        <form action="php/signup.inc.php" id="signupForm" method="post">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="uname" placeholder="Username" required>
            <input type="password" name="pwd" placeholder="Password" required>
            <input type="password" name="pwdrepeat" placeholder="Re-type Password" required>
            <button type="submit" name="submit" id="signupSubmit">Sign Up</button>
        </form>
    </div>
</div>



    <div class="signupAck">
    
    
    </div>

    <script src="js/source.js"></script>
    
</body>
</html>