<?php 
$logFile = "../../../Private/Merch/allMerch.json";
$fh = fopen($logFile, 'r+') or die("can't open file");

$category = $_REQUEST['category'];

$arrayOfMerch = file_get_contents($logFile);
$merchArray = json_decode($arrayOfMerch, true);
$byCategory = array();

foreach ($merchArray as $key => $jsons) { 
  if($jsons["category"]==$category) {
    $newArray = array($jsons["merchId"],$jsons["item"],$jsons["inventory"],$jsons["points"],$jsons["pictureLink"]);
    array_push($byCategory, $newArray);
  }
}

$i = 0;
foreach ($byCategory as $newArray) {
  $i ++;
  echo "<ul> ";
  echo "<h1>". "Item " . $i . "</h1> <p>" . $newArray[0] ."</p>";

  /*//AUTHORS
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
  echo "<br>";*/
}

?>