<!DOCTYPE html>

<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">


  <link
    href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Assistant:wght@300&family=Indie+Flower&display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">


  <link rel="stylesheet" href="CSS/styles.css">
  
  <!-- Stylesheets for the login navbar -->
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>

<script src="/js/script.js"> </script>

    <div class="login-navbar">
        <?php 
    include("../../Public/General/loginHeader.php");
    ?>
    </div>
    <div class="page-content-collections">
        <!-- Page Content -->
        <div class="sidebar viewBar white viewCard" style="width: 200px">
            <a href="../../Public/General/index.php"> <img class="imageClass" src="CSS/B&M.png" alt="bm"> </a>
        </div>

<div class="login-navbar" style="margin-bottom: 54.4px;">
    <div class="w3-top">
        <div class="w3-bar w3-white w3-wide w3-padding 3w-card">
            <a href="../../../Private/Books/collection.php" class="w3-bar-item w3-button"><b>Bookstore</b>x<b>Merch</b></a>
            <!-- Float links to the right. Hide them on small screens -->

            <!-- Doesn't register the user's name as session name for visualize -->
            <div class="w3-hide-small">
                <a href="#" class="w3-bar-item" style="display:none;">Welcome, <?php echo $loggedUser;?></a>
            </div>

            <div class="w3-right w3-hide-small">
                <a href="#" class="w3-bar-item w3-button">About us</a>
            </div>

            <div class="w3-right w3-hide-small">
                <a href="../../../Public/Merch/collection.php" class="w3-bar-item w3-button">Merch</a>
            </div>

            <div class="w3-right w3-hide-small">
                <a href="../../../Public/Profile/profile.php" class="w3-bar-item w3-button">Profile</a>
            </div>
        </div>
    </div>
</div>
        <div id="posts" style = "margin-left:240px">
            <div id="wrapper" style = "margin-left:240px">
				<h1>Community Posts </h1>
            </div>
			
        </div>
        <div id="original">
			<div>
				


  <?php 
  $logFile = "/Private/CommunityPosts/allPosts.JSON";

  

  $arrayOfPosts = file_get_contents(__DIR__ . "../../../Private/CommunityPosts/allPosts.JSON");
  $postsArray = (json_decode($arrayOfPosts, true));
  //echo var_dump($postshArray);
  $byTitle = array();
echo "<div>";
  foreach ($postsArray as $key => $jsons) { 
      $newArray = array($jsons["postTitle"],$jsons["Author"],$jsons["datePublication"],$jsons["Text"],$jsons["comments"]);
      array_push($byTitle, $newArray);
      echo "<ul><div class='card bookBorder'>";
      echo '<div><h3>'.$newArray[0].'</h3><hr class="horLine"><div><b> AuthorName: </b>'.$newArray[1].'</div><hr><div class="barCol"> <b> Post: </b>'.$newArray[3];
	 echo "<br><br><b> <button class='fixedButton' onclick='displayContent(".$newArray[7].")' id='".$newArray[7]."'> Show thread for  :  " . $newArray[0] . "</button></b> ".'</div></div></div></ul><br>';
		 }

  ?>
     	 	</div>
 	 	</div>

	</body>
</html>