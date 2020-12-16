<!-- Author: Imane | Date: Dec 7th, 2020--> 
<?php 
session_start();
if(isset($_SESSION["name"])) {
    $loggedIn = true;
    $loggedUser = $_SESSION["name"]; 
    $type = $_SESSION["type"]; 
  }

$content = $_REQUEST['content'];
$arrayOfBooks = file_get_contents("../../Books/BookDefault/Pending/allPendingBooks.json");
$books = json_decode($arrayOfBooks, true);
$booksArray = $books["requests"];
$newArray = array();

$i=0;
foreach ($booksArray as $key => $jsons) { 
    $i++;
    if($i==$content) {
        $newArray = array($jsons["title"],$jsons["author"],$jsons["illustrator"],
        $jsons["desc"],$jsons["url"],$jsons["rating"],$jsons["reviews"],
        $jsons["genre"]);
    break;
    }
}
$title = $newArray[0];
$author = $newArray[1];
$illustrator = $newArray[2];
$description = $newArray[3];
$url = $newArray[4];
$rating = $newArray[5];
$reviews = $newArray[6];
$genre = $newArray[7];


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

  <!-- Stylesheets for the login navbar -->
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>

<body>

<!-- <div id="booksGrid" class="gridContainer"> -->
    <div id="mainBook">
        <div class="newFont">
            <ol> 
                <span onclick='document.getElementById("bookDetails").style.display="none"' class="closeModal"
                    title="Close Modal">&times;</span>
                    <br><br><br>
                <li>  <div > <b> TITLE: </b> <?php echo $title ?></div> </li>
                <hr>
                <li>  <div > <b> GENRE: </b> <?php echo $genre ?></div> </li>
                <hr>
                <li> <div > <b> AUTHORS(s): </b> <?php for($j=0; $j<sizeof($author); $j++) { 
                    echo "<div>" . $author[$j] . " </div> ";} ?> </div> </li>
                <?php
                if(sizeof($illustrator)>0) {
                    echo "<li> <div > <b> ILLUSTRATOR(s): </b>";
                    for($j=0; $j<sizeof($illustrator); $j++) {
                        echo "<div>". $illustrator[$j]. "</div>";
                    }
                    echo "</div> </li>";
                    } ?>
                <hr>
                <li><div > <b> Description: <br> </b> <?php echo $description?>  </div> </li>
                <hr>
                <li>  <div > <b> Read me </b>  <?php echo "<a href=". $url."> here </a>"?> </div> </li>
            
            </ol> 
        </div>
    </div>
<!-- </div> -->
  </body>

</html>
