<?php 
$content = $_REQUEST['content'];
$logFile = "../allBooks.json";
$fh = fopen($logFile, 'r+') or die("can't open file");

$arrayOfBooks = file_get_contents($logFile);
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
// echo "<br>";
// echo "<div style='margin-left:220px'>";
// echo "<ul>";
// echo "<b> <p id='book".$bookid."'> " . $title  . "</p></b>";

// //AUTHORS
 
// echo "<div id='".$bookid."'>";
// echo "<p>". "AUTHOR(S): ";
// for($j=0; $j<sizeof($author); $j++) {
//     if($j != (sizeof($author) - 1)) {
//         echo $author[$j] . " | ";
//     } else {
//         echo $author[$j];
//     }
//   }
// echo "</p>";

// //ILLUSTRATORS
// if(sizeof($illustrator)>0) {
//     echo "<p>". "ILLUSTRATOR(S): ";
//     for($j=0; $j<sizeof($illustrator); $j++) {
//         if($j != (sizeof($illustrator) - 1)) {
//           echo $illustrator[$j] . " | ";
//         } else {
//           echo $illustrator[$j];
//         }
//     }
//     echo "</p>";
// }
  
// //SUMMARY
// echo "<p>". "SUMMARY: ";

// echo "<div>" . $description . "</div>";

// echo "</p>";


// //url
// echo "<a href=".$url."> Read me! </a>";
   

// //Rating
// echo "<p>". "RATING: " . $rating . "/5";
// echo "</p>";


// //REVIEWS
// echo "<p>". "Reviews: ";
//     for($j=0; $j<sizeof($reviews); $j++) {
//         echo $reviews[$j];
//     }
// echo "<br>";
// echo "<br>";
// echo "<a href='#'> Write a review</a>";
// echo "</p>";

// echo "</ul>";
// echo "<br>";

// echo "</div>";
// echo "</div>"; 
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
  <link rel="stylesheet" href="../CSS/bookshelf.css"> 
</head>

<body>

<script src="../JS/script5.js"> </script>


<div class="sidebar viewBar white viewCard" style="width: 200px">
    <img class="imageClass" src="../Images/b&m.png" alt="bm">

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
    <div class="card bookBorder">
        <h3><?php echo $title ?> </h3>
        <hr class="horLine"> 
        <div> <b> TITLE: </b> <?php echo $title ?></div> 
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
        echo "</div>"; } ?>
        <hr>
        <div class="barCol"> <b> SUMMARY: </b> 
        <br>
        <br>
            <div class="bookBorder"> 
                <?php echo $description?>
            </div>
        </div>
        <hr>
        <div class="barCol"> <a href="#"> <b> Rate this book</b></a>   (CURRENT RATING: <?php echo $rating?> ★ ) </div>
        <hr>
        <div class="barCol"> <a href="#"> <b> Review this book</b></a>  </div>
        <hr>
        
        <?php 
        if(sizeof($reviews)>0) {
            echo "<div class='barCol'> <b> Current reviews </b>";
            echo "<ul>";
            for($j=0; $j<sizeof($reviews); $j++) {
                echo "<li style='color:rgb(119,89,112)'> User: " . $reviews[$j]["user"];
                echo "<div style='color:black'>" . $reviews[$j]["text"] . "</div> </li>";
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
  </body>

</html>







