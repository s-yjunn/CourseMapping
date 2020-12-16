<!-- Author: Nukhbah Majid--> 
<?php
  session_start();
  if(isset($_SESSION["name"])) {
    $loggedIn = true;
    $loggedUser = $_SESSION["name"]; 
    $type = $_SESSION["type"]; 
  } else {
    $loggedIn = false;
    header("location: ../../Public/Login/login.php");
    exit;
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="styles/welcomeStyles.css" id="styles"> -->
</head>

<body>
    <script>
    </script>
    <!-- Navigation bar-->

    <nav class="w3-top" id="head-navbar" >
        <div class="w3-bar w3-white w3-wide w3-padding 3w-card">
            <a href="../../Private/Books/collection.php" class="w3-bar-item w3-button"><b>Bookstore</b>x<b>Merch</b></a>
            <!-- Float links to the right. Hide them on small screens -->

<!-- 
            <div class="w3-hide-small">
                <a href="../../Public/Profile/profile.php" class="w3-bar-item">Welcome></a>  
            </div> -->
            <div class="w3-hide-medium w3-hide-small">
                <button id="logoutButton" class="w3-bar-item w3-right buttonNavBar" style="cursor:pointer">Log Out</button>
            </div>
            <?php if($type=="admin") {

                echo "<div class='w3-hide-medium w3-hide-small'>
                            <a href='../../Private/Admin/admin.php' class='w3-bar-item buttonNavBar'>Admin</a>
                    </div>";
            }?>
            <div class="w3-hide-medium w3-hide-small">
                <a href="../../Public/index.php" class="w3-bar-item buttonNavBar"><i class='fas fa-home'></i>Home</a>
            </div>

            <div class="w3-hide-medium w3-hide-small">
                <a href="../../Public/Profile/profile.php" class="w3-bar-item buttonNavBar">Profile</a>
            </div>
            <div class='w3-hide-medium w3-hide-small'>
                <a href="../../Public/General/instructions.php" class="w3-bar-item buttonNavBar">Instructions</a>
            </div>

            <div class="w3-hide-medium w3-hide-small">
                <a href="#" class="w3-bar-item buttonNavBar">Community</a>
            </div>
        </div>
    </nav>

    <!-- <script src="../../Public/General/js/logOut.js"></script> -->
</body>

</html>