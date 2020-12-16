<!-- Author: Imane Berrada | Date: December 1st-->
<?php 

session_start();
  if(isset($_SESSION["name"]) and ($_SESSION["type"]=="admin")) {
    $loggedIn = true;
    $loggedUser = $_SESSION["name"]; 
    $type = $_SESSION["type"]; 
  } else {
    $loggedIn = false;
    header("location: ../../Public/Login/login.php");
    exit;
  }

$logFile = "pendingReq.JSON";
$arrayOfRequests = file_get_contents("pendingReq.JSON");
$requestsArray = json_decode($arrayOfRequests, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link
        href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Assistant:wght@300&family=Indie+Flower&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/adminStyles.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="styles/bookshelf.css">  -->
   
    <title>ADMIN</title>
</head>
<body>

    <div class="login-navbar">
    <nav class="w3-top" id="head-navbar" >
        <div class="w3-bar w3-white w3-wide w3-padding 3w-card">
            <a href="../../Private/Books/collection.php" class="w3-bar-item w3-button"><b>Bookstore</b>x<b>Merch</b></a>
            <!-- Float links to the right. Hide them on small screens -->
            <div class="w3-hide-medium w3-hide-small">
                <button id="logoutButton4" class="w3-bar-item w3-right buttonNavBar" style="cursor:pointer">Log Out</button>
            </div>
            <div class="w3-hide-medium w3-hide-small">
                <a href="#" class="w3-bar-item buttonNavBar">Actions</a>
            </div>

            <div class="w3-hide-medium w3-hide-small">
                <a href="../../Public/index.php" class="w3-bar-item buttonNavBar"><i class="fas fa-home">Home</i></a>
            </div>
            <div class="w3-hide-medium w3-hide-small">
                <a href="../../Private/Books/collection.php" class="w3-bar-item buttonNavBar"><i class="fas fa-book">Collections</i></a>
            </div>
            <div class="w3-hide-medium w3-hide-small">
                <a href="../../Public/Profile/profile.php" class="w3-bar-item buttonNavBar">Profile</a>
            </div>
        </div>
    </nav>
    </div>
    


    <div class="page-content-collections"> 
        <!-- Page Content -->
        <div class="sidebar viewBar white viewCard" style="width: 200px">
          <img class="imageClass" src="Images/adminLogo.png" alt="logo">

          <div class="newFont">
            <b class="barCol"><?php echo "Hello, " . $_SESSION["name"] ."!";?></b>
            <button class="barCol buttonClass" onclick="getRequests()">Pending Requests</button>
            <button class="barCol buttonClass" onclick="getUsers()">All Users</button>
            <button class="barCol buttonClass" onclick="getBooks()">All Books</button>
            <!-- <button class="barCol buttonClass" onclick="getReviews()">All Reviews</button> -->
    
          </div>
        </div>

        <h3 id="headerUsers" class="w3-center allUsers" style="display:none">All BxM Users </h3>
        
        <div id="userGrid" class="gridContainer" style="display:none">
        <!-- Get all the user info from the allUsers to display. -->
        <?php 
            $usersJSON = file_get_contents("../Users/allUsers.JSON");
            $rows= json_decode($usersJSON, true);

            $reviewsJSON = file_get_contents("../Books/BookDefault/Reviews/allReviews.json");
            $rowsReviews= json_decode($reviewsJSON, true);
    
            if(isset($_SESSION["name"])) {
                $name = $_SESSION["name"];
            } else {
                header("../../Public/index.php");
            }
            
            foreach ($rows as $key => $jsons) { 
                foreach($jsons as $key => $value) { 
    
                    $username = $value['username'];
                    $name = $value['name'];
                    $email = $value['email']; 
                    $type = $value['type'];
                    $booksUploaded = $value['myBooks'];
                    $reviews = $rowsReviews[$username];
                    
                    echo "<div class='userCard'>";
                        if ($type == "user") {
                            echo "<img src='Images/user.png' style='width:100%'>";
                        } else {
                            echo "<img src='Images/admin.png' style='width:100%'>";
                        }
                        echo "<h1>".$name."</h1>";
                        echo "<p class='userTitle'>".strtoupper($type)."</p>";
                        echo "<dl>";
                        echo "<dt> Number of reviews: <b>".sizeof($reviews)."</b></dt>";
                        echo "<dt> Number of books uploaded: <b>".sizeof($booksUploaded)."</b></dt>";
                        echo "</dl>";
                    echo "</div>";
                }
            }      
        ?>
        </div>

        <h3 id="headerBooks" class="w3-center allUsers" style="display:none">All BxM Books </h3>

        <div id="bookGrid" class="gridContainer" style="display:none">
        <!-- Get all the book info from the allBooks.JSON to display. -->
        <?php 
            $arrayOfBooks = file_get_contents("../Books/allBooks.JSON");
            $booksArray = json_decode($arrayOfBooks, true);
            $byGenre = array();
            
            foreach ($booksArray as $key => $jsons) { 

            $newArray = array($jsons["title"],$jsons["author"],$jsons["illustrator"],$jsons["description"],$jsons["url"],$jsons["rating"],$jsons["reviews"],$jsons["bookid"]);
            array_push($byGenre, $newArray);
              
            }
            foreach ($byGenre as $newArray) {
                echo "<b> <button onclick='displayContent(".$newArray[7].")' class='fixedButton' id='".$newArray[7]."'> " . $newArray[0] . "</button></b> ";

            } 
            
        ?>
        </div>

        <h3 id="headerReviews" class="w3-center allUsers" style="display:none">All BxM Reviews </h3>

        <div id="reviewsGrid" class="gridContainer" style="display:none">
        <!-- Get all the book info from the allBooks.JSON to display. -->
        <?php 
            $arrayOfBooks = file_get_contents("../Books/allBooks.JSON");
            $booksArray = json_decode($arrayOfBooks, true);
            $byGenre = array();
            
            foreach ($booksArray as $key => $jsons) { 

            $newArray = array($jsons["title"],$jsons["author"],$jsons["illustrator"],$jsons["description"],$jsons["url"],$jsons["rating"],$jsons["reviews"],$jsons["bookid"]);
            echo "<div class='userCard'>";
            echo "<h1>".$newArray[0]."</h1>";
            
            $i=0;
            foreach ($jsons["reviews"] as $review) {
                $i++;
                echo "<p onclick='displayReview(".$review.")' class='userTitle'> Review ".$i."</p>";
                $j=0;
                // foreach ($review as $rev) { 
                //     $j++;
                //     if($j==0) {
                //         echo "<p style='font-weight:bold'> User: " . $rev;
                //     } else {
                //         echo $rev . " </p>";
                //     }
                    
                // } 
            }
            echo "</div>";
            }          
        ?>
        </div>


        <h3 id="headerRequests" class="w3-center allUsers" style="display:block"> Pending Requests </h3>
        <div id="requestsGrid" class="gridContainer" style="display:block">
            <div id="pending" class="card2">
    
                <div id="pendingReq">
                    <div id="main">
                        <h3 style="text-align:center"> Pending Requests </h3>

                        <div class="menu-bar">
                            <button id="acceptAll" class="acceptAll w3-center" >Accept all requests</button>
                        </div>
                        <hr>
                        <div id="showAll" class="tasks-container">
                        </div>
                        
                        <hr>
                        <div class='footer'>
                            <div class='task-count'>
                                <p id='pendingRequests' class='fs-med bold'>0</p>&nbsp
                                <p class='fs-med'>pending request(s)</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <p id="bookDetails"> </p>
        </div>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/logOut-admin.js"> </script>
    <script src="js/scriptAdmin.js"> </script>


</body>
</html>