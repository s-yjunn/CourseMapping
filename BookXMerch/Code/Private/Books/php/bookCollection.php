<?php 
$logFile = "../allBooks.json";
$fh = fopen($logFile, 'r+') or die("can't open file");

$genre = $_REQUEST['genre'];

$arrayOfBooks = file_get_contents($logFile);
$booksArray = json_decode($arrayOfBooks, true);
$byGenre = array();

foreach ($booksArray as $key => $jsons) { 
  if($jsons["genre"]==$genre) {
    $newArray = array($jsons["title"],$jsons["author"],$jsons["illustrator"],$jsons["description"],$jsons["url"],$jsons["rating"],$jsons["reviews"]);
    array_push($byGenre, $newArray);
  }
}

$i = 0;
foreach ($byGenre as $newArray) {
  $i ++;
  echo "<ul>";
  echo "<h1> <button onclick='displayContent(".$i.")' id='book".$i."'> Book " . $i . "</button></h1><p>" . $newArray[0] ."</p>";

  //AUTHORS
  echo "<div id='".$i."' style='display:none'>";
  echo "<p>". "AUTHOR(S): ";
  for($j=0; $j<sizeof($newArray[1]); $j++) {
      if($j != (sizeof($newArray[1]) - 1)) {
        echo $newArray[1][$j] . " | ";
      } else {
        echo $newArray[1][$j];
      }
  }
  echo "</p>";

  //ILLUSTRATORS
  if(sizeof($newArray[2])>0) {
    echo "<p>". "ILLUSTRATOR(S): ";
    for($j=0; $j<sizeof($newArray[2]); $j++) {
        if($j != (sizeof($newArray[2]) - 1)) {
          echo $newArray[2][$j] . " | ";
        } else {
          echo $newArray[2][$j];
        }
    }
    echo "</p>";
  }
  
  //SUMMARY
  echo "<p>". "SUMMARY: ";

  echo "<div>" . $newArray[3] . "</div>";

  echo "</p>";


  //url
  echo "<a href=".$newArray[4]."> Read me! </a>";
   

  //Rating
  echo "<p>". "RATING: " . $newArray[5] . "/5";
  echo "</p>";


  //REVIEWS
  echo "<p>". "Reviews: ";
    for($j=0; $j<sizeof($newArray[6]); $j++) {
        echo $newArray[6][$j];
    }
    echo "<br>";
    echo "<br>";
    echo "<a href='#'> Write a review</a>";
  echo "</p>";

  echo "</ul>";
  echo "<br>";
}
echo "</div>";

?>


