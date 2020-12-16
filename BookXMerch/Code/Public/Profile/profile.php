<!-- Authors: Imane Berrada and Nukhbah Majid| Date: Dec 2020--> 
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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    
   
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
            <a class="barCol buttonClass" href="../../Public/Profile/profile.php" style="width: 200px; font-family">My Details</a>
            <button class="barCol buttonClass" id="reading-list-button" onclick="getList()">My Reading List</button>
            <button class="barCol buttonClass" onclick="getUpload()">Upload a Book</button>
            <button class="barCol buttonClass" onclick="getBooks()">My Books</button>
            <button class="barCol buttonClass" onclick="#">My Posts</button>
            <button class="barCol buttonClass" onclick="getReviews()">My Reviews</button>
            <!-- <button class="barCol buttonClass" onclick="getRatings()">My Ratings</button> -->

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

    <!-- Div for the user details -->
        <div class="card" id="userDetails">
            <div class="tabcontent bookBorder">
                <h3 class="w3-center"><?php  echo "Hello, " .$_SESSION['name']."!"; ?> </h3>
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
    <!-- Div for the reading list -->
    <div id="savedList">Your reading list was saved!</div>
    <div id="rList" class="card" style="display:none">
    
        <div id="readingListWrapper" class="tabcontent">

        
            <div id="main2" class="container">
                <h3 style="text-align:center"> <?php echo $_SESSION["name"]?>'s Reading List </h3>
                <button id="saveReadingList" class="saveReadingList" onclick="passVal()"> Save list</button>

                <div class="menu-bar">
                    <p id="clearComplete" class="fs-med2">Clear Completed Books</p>
                </div>
                <hr>
                <div id="showAll" class="tasks-container">
                </div>
                
                <hr>
                <div class='footer'>
                    <div class='task-count'>
                        <p id='taskLeftCount' class='fs-med bold'>0</p>&nbsp
                        <p class='fs-med'>book(s) on the Reading List</p>
                    </div>
                </div>
                <div class='filter'>
                    <p id='show-all' class='filter-button-RL'>All</p>
                    <p id='showComplete' class='filter-button-RL'>Completed</p>
                    <p id='showInprogress' class='filter-button-RL'>In-progress</p>
                    <p id='showNotStarted' class='filter-button-RL'>Not-Started</p>
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
                <div class="reviews-container">
                    <!-- show all the reviews as a list here -->
                    <div class="task-card">
                        <div class="status-icon-review"></div>
                        <p class="task-text">Sample Book</p>
                        <p class="task-status color-blue">This was an amazing book! I still can't get over that one jump scare part. A truly otherworldly experience!</p>
                    </div>
                </div>

                <hr>
            </div>
        </div>
    </div>
    
    <!-- Div for the book upload -->

    <div>
        <div id="uploadButton" class="w3-center w3-display-middle w3-margin-top" style="display:none">
            <h1 class="w3-xxxlarge w3-text-white"><span  style="overflow:hidden">
                <img class="uploadButton" src="../General/styles/uploadLogo.png" onclick="showUploadModal()">  </span>
            </h1>
             
        </div>
    </div>

    <br>
    <!-- Upload FORM-->
    <div id="uploadForm" class="w3-center modal-content animate" style="display:none">
        <div class="imgcontainer-upload">
                <span onclick="closeUploadModal()" class="closeModal"
                    title="Close Modal">&times;</span>
                <img src="../General/styles/uploadLogo.png" alt="Avatar" class="avatar">
        </div>

        <div class="container-upload">
            
            <form id="uploadForm-data" method="post" action="php/bookUpload.php">
                <label class="label" for="genre"><b>Genre*</b></label>
   
                <select id="genre" name="genre">
                    <option value="comics">Comic Books</option>
                    <option value="children">Children's Books</option>
                    <option value="sci-fi">Science Fiction</option>
                    <option value="fiction">Fiction</option>
                    <option value="nonfiction">Nonfiction</option>
                    <option value="debut-novel">Debut Novel</option>
                    <option value="horror">Horror</option>
                    <option value="romance">Romance</option>
                    <option value="other">Other</option>
                </select>
                <br>
                <br>
                <label class="label" for="text"><b>Title</b></label>
                <input type="title" name="title" placeholder="Title" required>
                <br>
                <label class="label" for="text"><b>Author(s)**</b></label>
                <input type="author" name="author" placeholder="Author" required>
                <br>
                <label class="label" for="text"><b>Illustrator(s)**</b></label>
                <input type="text" name="illustrator" placeholder="Illustrator">
                <br>
                <label class="label" for="summary"><b>Short Summary</b></label>
                <textarea name="summary" name="summary" wrap="soft" placeholder="Summary" required> </textarea>
                <br>
                <label class="label" for="url"><b>Book URL</b></label>
                <input type="url" name="url" placeholder="url">
                <br>
                <br>
                <button type="submit" name="submit" id="uploadSubmit" class="upload">Upload</button>
                <p class="asterisk"> *drop-down menu available</p>
                <p class="asterisk"> **comma-separated if multiple</p>
            </form>
        </div>
    </div>
    
    <?php $success = $_REQUEST['success'];
    if ($success==1 ) {
        echo "<div id='successUpload2'>Your book upload was successful! <span class='closeSuccess' onclick='closeSuccess()'>&times;</span></div>";
    }?>
    <!-- My books -->
    <div id="booksList" class="card" style="display:none">
        <div id="reviewsListWrapper" class="tabcontent">
            <div id="main" class="container">
                <h3 style="text-align:center"> <?php echo $_SESSION["name"]?>'s Books </h3>
                <hr>
                <?php 
                
                $arrayOfUsers = file_get_contents("../../Private/Users/allUsers.JSON");
                $usersArray = json_decode($arrayOfUsers, true);
                $newArray = array();
                
                $i=0;
                foreach ($usersArray["users"] as $key => $jsons) { 
                    if($jsons["username"]==$_SESSION["username"]){
                        for($i=0;$i<sizeof($jsons["myBooks"]);$i++) {
                            array_push($newArray,array(
                            $jsons["myBooks"][$i]["title"],
                            $jsons["myBooks"][$i]["author"],
                            $jsons["myBooks"][$i]["illustrator"],
                            $jsons["myBooks"][$i]["description"],
                            $jsons["myBooks"][$i]["url"],
                            $jsons["myBooks"][$i]["rating"],
                            $jsons["myBooks"][$i]["bookid"]
                            ));
                        }
                        
                    break;
                    }
                  
                }
                foreach ($newArray as $arr) {
                    echo "<button onclick='displayBookContent(".$arr[6].")' class='myBooksButton w3-center' id='".$arr[6]."'> " . $arr[0] . "</button>";
                    echo "<br>";
                } 
                ?>
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
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
</body>
</html>