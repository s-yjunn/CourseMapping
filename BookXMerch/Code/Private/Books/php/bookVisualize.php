<!-- Authors: Imane Berrada and Nukhbah Majid| Date: Nov-Dec 2020--> 
<?php 
session_start();
if(isset($_SESSION["name"])) {
    $loggedIn = true;
    $loggedUser = $_SESSION["name"]; 
    $type = $_SESSION["type"]; 
  }

$content = $_REQUEST['content'];
$logFile = "../allBooks.JSON";


$arrayOfBooks = file_get_contents("../allBooks.JSON");
$booksArray = json_decode($arrayOfBooks, true);
$newArray = array();

foreach ($booksArray as $key => $jsons) { 
  if($jsons["bookid"]==$content) {
      $newArray = array($jsons["title"],$jsons["author"],$jsons["illustrator"],
      $jsons["description"],$jsons["url"],$jsons["rating"],$jsons["reviews"],
      $jsons["bookid"],$jsons["genre"]);
  break;
  }
}
$bookid = $newArray[7];
$title = $newArray[0];
$author = $newArray[1];
$illustrator = $newArray[2];
$description = $newArray[3];
$url = $newArray[4];
$rating = $newArray[5];
$reviews = $newArray[6];
$genre = $newArray[8];


// SESSION NAME PLEASE WORK!!!
session_start();
// $loggedUser = $_REQUEST['sessionName'];
$loggedUser = $_SESSION["name"]; 
?>

<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">


  <link
    href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Assistant:wght@300&family=Indie+Flower&display=swap"
    rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">


  <link rel="stylesheet" href="../CSS/styles.css">

  
  <!-- Stylesheets for the login navbar -->
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>

<div class="login-navbar" style="margin-bottom: 54.4px;">
    <div class="w3-top">
        <div class="w3-bar w3-white w3-wide w3-padding 3w-card">
            <a href="../../../Private/Books/collection.php" class="w3-bar-item w3-button"><b>Bookstore</b>x<b>Merch</b></a>
            <!-- Float links to the right. Hide them on small screens -->


            <?php if($type=="admin") {

            echo "<div class='w3-hide-medium w3-hide-small'>
                        <a href='../../Admin/admin.php' class='w3-bar-item buttonNavBar'>Admin page</a>
                </div>";
            }?>

            <div class="w3-hide-medium w3-hide-small">
                <a href="../collection.php" class="w3-bar-item buttonNavBar">Collections</a>
            </div>
            <div class="w3-hide-medium w3-hide-small">
                <button id="logoutButton" class="w3-bar-item w3-right buttonNavBar" style="cursor:pointer">Log Out</button>
            </div>
            <!-- <div class="w3-hide-medium w3-hide-small">
                <a href="../../../Public/index.php" class="w3-bar-item buttonNavBar">Home</a>
            </div> -->
            <div class="w3-hide-medium w3-hide-small">
                <a href="../../../Public/Profile/profile.php" class="w3-bar-item buttonNavBar">Profile</a>
            </div>
            <div class="w3-hide-medium w3-hide-small">
                <a href="#" class="w3-bar-item buttonNavBar">Community</a>
            </div>
        </div>
    </div>
</div>


<div class="sidebar viewBar white viewCard" style="width: 200px">
    <img class="imageClass" src="../Images/B&M.png" alt="bm">

    <div class="newFont">
        <button class="barCol buttonClass" onclick="window.location.href='../collection.php'" style="width: 200px; font-family"><b>Full B</b>x<b>M Collection</b></button>
        <ol> 
            <div class="info"> Book Info </div>
            <li>  <div class="barCol"> <b> TITLE: </b> <?php echo $title ?></div> </li>
            <li> <div class="barCol"> <b> AUTHORS(s): </b> <?php for($j=0; $j<sizeof($author); $j++) { 
                echo "<div>" . $author[$j] . " </div> ";} ?> </div> </li>
            <?php
            if(sizeof($illustrator)>0) {
                echo "<li> <div class='barCol'> <b> ILLUSTRATOR(s): </b>";
                for($j=0; $j<sizeof($illustrator); $j++) {
                    echo "<div>". $illustrator[$j]. "</div>";
                }
                echo "</div> </li>";
                } ?>
            <li>  <div class="barCol"> <b> CURRENT RATING: <br> </b> <?php echo $rating?> ★  </div> </li>
            <li>  <div class="barCol"> <b> Read me </b>  <?php echo "<a href=". $url."> here </a>"?> </div> </li>
        
        </ol> 
        
    </div>
  </div>

  <br>
  <div class="tabcontent">
    <div class="card bookBorder" id="bookDetails">
        <div class="addToList" onclick="addToList(<?php echo $bookid?>)">
            <div class="borderCaption">Add to Reading List</div> 
            <a> <img class="borderImage" src="../Images/addToList.png" alt="Add to list"> </a>
        </div>
        <div id="overlay" onclick="off()" style="display: none">
            <div id="alert"> </div>
        </div>
        
        <h3><?php echo $title ?> </h3>
        <hr class="horLine"> 
        <div id="titleOfBook"> 
            <b> TITLE: </b> <?php echo $title ?>
        </div> 
        <hr> 
        <div class="barCol"> <b> AUTHORS(s): </b> 
        <?php for($j=0; $j<sizeof($author); $j++) {
                if($j != (sizeof($author) - 1)) {
                    echo $author[$j] . " | ";
                } else {
                    echo $author[$j];
                }
            } ?> 
        </div> 
        <hr> 
        <?php if(sizeof($illustrator)>0) {
        echo "<div class='barCol'>". "<b> ILLUSTRATOR(s): </b> ";
        for($j=0; $j<sizeof($illustrator); $j++) {
            if($j != (sizeof($illustrator) - 1)) {
            echo $illustrator[$j] . " | ";
            } else {
            echo $illustrator[$j];
            }
        }
        echo "</div> <hr>"; } ?>
        
        <div class="barCol"> <b> SUMMARY: </b> 
        <br>
        <br>
            <div class="bookBorder"> 
                <?php echo $description?>
            </div>
        </div>
        <hr>
        <!-- <div class="barCol"> <a href="#"> <b> Rate this book</b></a>   (CURRENT RATING:  ★ ) </div>
        <hr> -->
        <div class="barCol"> <a href="newReview.php?content=<?php echo $bookid;?>" > <b> Review this book</b></a></div>
        <hr>
        
        <?php 
        if(sizeof($reviews)>0) {
            echo "<div class='barCol'> <b> Current reviews </b>";
            echo "<ul>";
            for($j=0; $j<sizeof($reviews); $j++) {
                echo "<li style='color:rgb(119,89,112)'>" . $reviews[$j]["user"] . ": ";
                echo "<div style='color:black'>" . $reviews[$j]["comment"] . "</div> </li>";
                if ($j != sizeof($reviews) - 1 ) {
                    echo "<hr>";
                };
            }
            echo "</ul>";
            echo "<hr>";
        }
        ?>
 
    <div class="barCol"> <b> Get a copy of the book </b>  <?php echo "<a href=". $url."> here </a>"?> </div> 
    </div>
</div>

    <br>
    <br>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../JS/logOut-fromBookVisualize.js"> </script>
    <script src="../JS/scriptCollections.js"> </script>
  </body>

</html>







