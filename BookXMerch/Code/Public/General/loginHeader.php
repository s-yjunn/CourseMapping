<?php
  session_start();
  if(isset($_SESSION["name"])) {
      $loggedUser = $_SESSION["name"]; 
  } else {
      header("location: ../Login/login.php");
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
    <!---- <link rel="stylesheet" href="CSS/styles.css" id="styles" ---->
</head>

<body>
    <!-- Navigation bar-->
    <div class="w3-top">
        <div class="w3-bar w3-white w3-wide w3-padding 3w-card">
            <a href="../../Private/Books/collection.php" class="w3-bar-item w3-button"><b>Bookstore</b>x<b>Merch</b></a>
            <!-- Float links to the right. Hide them on small screens -->

            <div class="w3-hide-small">
                <a href="#" class="w3-bar-item">Welcome, <?php echo $loggedUser?></a>
            </div>

            <div class="w3-right w3-hide-small">
                <a href="#" class="w3-bar-item w3-button">About us</a>
            </div>

            <div class="w3-right w3-hide-small">
                <a href="../../Public/Merch/collection.php" class="w3-bar-item w3-button">Merch</a>
            </div>

            <div class="w3-right w3-hide-small">
                <a href="#" class="w3-bar-item w3-button">Community</a>
            </div>

            <div class="w3-right w3-hide-small">
                <a href="../../Public/Profile/profile.php" class="w3-bar-item w3-button">Profile</a>
            </div>
        </div>
    </div>

</body>

</html>