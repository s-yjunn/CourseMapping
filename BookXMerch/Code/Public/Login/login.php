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
    <link rel="stylesheet" href="styles/styles.css">
    <title>Login</title>
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
                <a href="#" class="w3-bar-item w3-button">Merch</a>
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

    <div class="w3-center">
        <h1>LOGIN PAGE</h1>
    </div>


   <form action="php/login.inc.php" id="loginForm" method="post">
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="pwd" placeholder="Password" required>
        <button type="submit" name="submit" id="loginSubmit">Log In</button>
   </form>

   <div class="loginAck">
   
   </div>

   <script src="js/source.js"></script>
</body>
</html>