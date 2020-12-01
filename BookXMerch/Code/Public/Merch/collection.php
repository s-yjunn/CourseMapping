<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">


  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Assistant:wght@300&family=Indie+Flower&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="CSS/styles.css">
</head>

<?php
  session_start();
  if(isset($_SESSION["name"])) {
    $loggedIn = true;
    $loggedUser = $_SESSION["name"]; 
  } else {
    $loggedIn = false;
    header("location: ../../Public/Login/login.php");
    exit;
  }

?>

<body>

  <script src="JS/script.js"> </script>

  <div class="login-navbar">
    <nav class="w3-top" id="head-navbar" >
          <div class="w3-bar w3-white w3-wide w3-padding 3w-card">
              <a href="../../Private/Books/collection.php" class="w3-bar-item w3-button"><b>Bookstore</b>x<b>Merch</b></a>
              <!-- Comment: Float links to the right. Hide them on small screens -->


              <div class="w3-hide-small">
                  <a href="../../Public/Profile/profile.php" class="w3-bar-item">Welcome, <?php echo $loggedUser?></a>  
              </div>
              <div class="w3-hide-medium w3-hide-small">
                  <button id="logoutButton3" class="w3-bar-item w3-right buttonNavBar" style="cursor:pointer">Log Out</button>
              </div>
              <div class="w3-hide-medium w3-hide-small">
                  <a href="../../Public/index.php" class="w3-bar-item buttonNavBar">Home</a>
              </div>
              <div class="w3-hide-medium w3-hide-small">
                  <a href="../../Public/Profile/profile.php" class="w3-bar-item buttonNavBar">Profile</a>
              </div>

              <div class="w3-hide-medium w3-hide-small">
                  <a href="#" class="w3-bar-item buttonNavBar">Community</a>
              </div>
          </div>
    </nav>
  </div>

  <div class="page-content-collections">
    <div class="sidebar viewBar white viewCard" style="width: 200px">
        <img class="imageClass" src="Images/b&m.png" alt="bm">

        <div class="newFont">
          <a class="barCol buttonClass" href="../index.php" style="width: 200px; font-family"><b>Bookstore</b>x<b>Merch</b></a>
          <button class="barCol buttonClass" onclick="getMerchByCategory('Clothing')">Clothing</button>
          <button class="barCol buttonClass" onclick="getMerchByCategory('Collectibles')">Collectibles</button>
          <button class="barCol buttonClass" onclick="getMerchByCategory('Other')">Other</button>
        </div>
      </div>
  </div>

  


  <div id="Merch" class="center">
    <div id="wrapper" class="wrapper">
    </div>
  </div>

  <div id="original"> 
    <div class="wrapper">

      <div id="Colthing"> <button class="imgButton" onclick="getMerchByCategory('Clothing')"><img class="imageClass"  src="Images/shirt.png" alt="bm"></button></div>
      <div id="Collectibles"> <button class="imgButton" onclick="getMerchByCategory('Collectibles')"> <img class="imageClass" src="Images/mug.png" alt="bm"></button></div>
      <div id="Other"> <button class="imgButton" onclick="getMerchByCategory('Other')"><img class="imageClass" src="Images/notebook.png" alt="bm"></button></div>
    </div>
  </div>

</body>


</html>





