<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link
        href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Assistant:wght@300&family=Indie+Flower&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="styles/profileStyles2.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="styles/bookshelf.css">  -->
   
    <title>Profile</title>
</head>
<body>

    <div class="login-navbar">
        <?php 
        include("php/loginHeader.php");
        ?>
    </div>
    


    <div class="page-content-collections"> 
        <!-- Page Content -->
        <div class="sidebar viewBar white viewCard" style="width: 200px">
          <img class="imageClass" src="../../Private/Books/Images/B&M.png" alt="bm">

          <div class="newFont">
            <b class="barCol"><?php echo "Hello, " . $_SESSION["name"] ."!";?></b>
            <a class="barCol buttonClass" href="../../Public/Profile/profile.php" style="width: 200px; font-family">User Details</a>
            <button class="barCol buttonClass" id="reading-list-button" onclick="getList()">My Reading List</button>
            <button class="barCol buttonClass" onclick="#">My Books</button>
            <button class="barCol buttonClass" onclick="#">My Posts</button>
            <button class="barCol buttonClass" onclick="getReviews()">My Reviews</button>
            <button class="barCol buttonClass" onclick="getRatings()">My Ratings</button>
    
          </div>
        </div>

        <!-- Get all the user info from the allUsers to display. -->
        <?php 
            $usersJSON = file_get_contents("../../Private/Users/allUsers.JSON");
            $rows= json_decode($usersJSON, true);
    
            echo "<br>";
    
            if(isset($_SESSION["name"])) {
                $name = $_SESSION["name"];
            } else {
                header("../../Public/General/index.php");
            }
            
    
            foreach ($rows as $key => $jsons) { 
                foreach($jsons as $key => $value) { 
                    if($name == $value['name']) {
                        $username = $value['username'];
                        $email = $value['email']; 
                        // $type = $value['type'];

                    }
                }
            }
        
        
        ?>


        <div class="tabcontent" id="userDetails">
            <div class="card bookBorder">
                <h3><?php echo $_SESSION['name']; ?> </h3>
                <hr class="horLine"> 
                <div> <b> Name: </b> <?php echo $name; ?></div> 
                <hr> 
                <div class="barCol"> <b> Username: </b> 
                <?php echo $username; ?> 
                </div> 
                <hr> 
                <div class="barCol"> <b> Email: </b> 
                <?php echo $email; ?> 
                </div> 
                <hr>
                <div class="barCol"> <b> Other details: </b> 
                <?php echo "~"; ?> 
                </div>
                <hr>
                
            </div>   
        </div>
            
    <div id="rList" class="card" style="display:none">
    
        <div id="readingListWrapper" class="tabcontent">
        Status: IN PROGRESS
            <div id="main" class="container">
                <h3 style="text-align:center"> <?php echo $_SESSION["name"]?>'s Reading List </h3>
                <div class="add-bar">
                    <img src="../../Private/Books/Images/B&M.png" style="width:2.5em"> </img>
                    <input type="text" id="new-task" placeholder="Add books...">
                    <ion-icon id="add-button" name="add-circle-outline" class="mg-10 fs-large"></ion-icon>
                </div>
                <div class="menu-bar">
                    <div id="check-all-button">
                        <ion-icon name="checkmark-done-outline"></ion-icon>
                        <p id="completeAll" class="fs-med">Complete All Books</p>
                    </div>
                    <p id="clearComplete" class="fs-med">Clear Completed Books</p>
                </div>
                <hr>
                <div id="show-all" class="tasks-container">
                    <div class="task-card not-started" id="t1">
                        <div class="status-icon"></div>
                        <p class="task-text">BOOK1</p>
                        <p class="task-status color-red">Not-Started</p>
                        <ion-icon class="delete fs-large mg-10" name="close-circle-outline"></ion-icon>
                    </div>
                    <div class="task-card not-started" id="t2">
                        <div class="status-icon"></div>
                        <p class="task-text">BOOK2</p>
                        <p class="task-status color-red">Not-Started</p>
                        <ion-icon class="delete fs-large mg-10" name="close-circle-outline"></ion-icon>
                    </div>
                    <div class="task-card Completed" id="t3">
                        <div class="status-icon"></div>
                        <p class="task-text">BOOK3</p>
                        <p class="task-status color-green">Completed</p>
                        <ion-icon class="delete fs-large mg-10" name="close-circle-outline"></ion-icon>
                    </div>
                    <div class="task-card In-progress" id="t4">
                        <div class="status-icon"></div>
                        <p class="task-text">BOOK4</p>
                        <p class="task-status color-blue">In-progress</p>
                        <ion-icon class="delete fs-large mg-10" name="close-circle-outline"></ion-icon>
                    </div>
                    <div class="task-card In-progress" id="t5">
                        <div class="status-icon"></div>
                        <p class="task-text">BOOK5</p>
                        <p class="task-status color-blue">In-progress</p>
                        <ion-icon class="delete fs-large mg-10" name="close-circle-outline"></ion-icon>
                    </div>
                </div>

                <hr>
                <div class="footer">
                    <div class="task-count">
                        <p id="task-left-count" class="fs-med bold">3 </p>&nbsp
                        <p class="fs-med">books on the Reading List</p>
                    </div>
                    <div class="filter">
                        <p id='showAll' class="filter-button">All</p>
                        <p id='showComplete' class="filter-button">Completed</p>
                        <p id='showInprogress' class="filter-button">In-progress</p>
                        <p id='showNotStarted' class="filter-button">Not-started</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Div for the reviews -->
    <div id="reviewsList" class="card" style="display:none">
    
        <div id="reviewsListWrapper" class="tabcontent">
            <div id="main" class="container">
                <h3 style="text-align:center"> <?php echo $_SESSION["name"]?>'s Reviews </h3>
                <hr>
                <div id="show-all" class="reviews-container">
                    <!-- show all the reviews as a list here -->
                    <div class="task-card In-progress" id="t5">
                        <div class="status-icon"></div>
                        <p class="task-text">Sample Book Review</p>
                        <p class="task-status color-blue">This was an amazing book! I still can't get over that one jump scare part. A truly otherworldly experience!</p>
                    </div>
                </div>

                <hr>
                <!-- <div class="footer">
                    <div class="task-count">
                        <p id="task-left-count" class="fs-med bold">3 </p>&nbsp
                        <p class="fs-med">books on the Reading List</p>
                    </div>
                    <div class="filter">
                        <p id='showAll' class="filter-button">All</p>
                        <p id='showComplete' class="filter-button">Completed</p>
                        <p id='showInprogress' class="filter-button">In-progress</p>
                        <p id='showNotStarted' class="filter-button">Not-started</p>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    


        
    <!-- Page Content End (below) -->
    </div>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/logOut-profile.js"> </script>
    <script src="js/scriptProfile.js"> </script>
    <!-- <script src="js/scriptProfile2.js"></script> -->
    <!-- ICONS -->
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
</body>
</html>