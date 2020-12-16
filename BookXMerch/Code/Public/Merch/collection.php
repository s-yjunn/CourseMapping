<!-- Author: Mariem Snoussi | Date: Dec 7th, 2020--> 
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">


  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Assistant:wght@300&family=Indie+Flower&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="CSS/styles.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
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
                  <a href="../../Public/index.php" class="w3-bar-item buttonNavBar"><i class='fas fa-home'></i>Home</a>
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
      </div>
  </div>

  


  <div id="Merch" class="center">
    <div id="wrapper" class="wrapper">
    </div>
  </div>

  <div id="original"> 
    <div class="wrapper">
		<!--
	  <?php 
	  $logFile = "../../../Private/Merch/allMerch.JSON";

	  $arrayOfMerch = file_get_contents(__DIR__ . "../../../Private/Merch/allMerch.JSON");
	  $merchArray = (json_decode($arrayOfMerch, true));
	  //echo var_dump($merchArray);
	  echo "<div>";
	  foreach ($merchArray as $key => $jsons) { 
	      $newArray = array($jsons["category"],$jsons["item"],$jsons["inventory"],$jsons["points"],$jsons["url"]);
  	    echo "<ul>";
  	    echo "<b> <button class='fixedButton' id='".$newArray[1]."'><a href = '.$newArray[4].'download ></button></b> ";
  	    echo "</ul>";
	  }
	   echo "</div>";
	  
	  ?>
			--->
	<div>
		<ul class="ulClass">
      <li>
      <p style='color:white'> Download our 2021 Calendar</p>
        <b><button class = 'merchButton' id='calendar'>
          <a href = 'Images/calendar.pdf' download>
          <img src="Images/calendar.png" alt="calendar"width="200" height="200">
        </a></button></b>
        <br>
      </li>
			<li>
      <p style='color:white'> Download our Notebook</p>
        <b><button class = 'merchButton' id='notebook'>
          <a href = 'Images/notebook.pdf' download>
          <img src="Images/notebook.png" alt="notebook" width="200" height="200">
        </a></button></b>
        <br>
      </li>
			<li>
      <p style='color:white'> Download our Birthday Card</p>
        <b><button class = 'merchButton' id='birthdayCard'>
          <a href = 'Images/birthdayCard.pdf' download>
          <img src="Images/birthdayCard.png" alt="birthdayCard" width="200" height="200">
        </a></button></b><br></li>
		</ul>
	</div>
  </div>

</body>


</html>





