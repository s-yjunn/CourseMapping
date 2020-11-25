<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link
        href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Assistant:wght@300&family=Indie+Flower&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="styles/profileStyles.css">
    <link rel="stylesheet" href="styles/bookshelf.css"> 
   
    <title>Profile</title>
</head>
<body>

    <div class="login-navbar">
        <?php 
        include("../General/loginHeader.php");
        ?>
    </div>
    


    <div class="page-content-collections"> 
        <!-- Page Content -->
        <div class="sidebar viewBar white viewCard" style="width: 200px">
          <img class="imageClass" src="../../Private/Books/Images/B&M.png" alt="bm">

          <div class="newFont">
            <b class="barCol"><?php echo "Hello, " . $_SESSION["name"] ."!";?></b>
            <button class="barCol buttonClass" onclick="booksOfMonth()" style="width: 200px; font-family">User Details</button>
            <button class="barCol buttonClass" onclick="getBookByGenre('comics')">My Books</button>
            <button class="barCol buttonClass" onclick="getBookByGenre('children')">My Posts</button>
            <button class="barCol buttonClass" onclick="getBookByGenre('sci-fi')">My Reviews</button>
            <button class="barCol buttonClass" onclick="getBookByGenre('fiction')">My Ratings</button>
    
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


        <div class="tabcontent">
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

        
      <!-- Page Content End (below) -->
    </div>

    

</body>
</html>