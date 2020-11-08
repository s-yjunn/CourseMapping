<?php 
$logFile = "allBooks.json";
$fh = fopen($logFile, 'r+') or die("can't open file");

$arrayOfBooks = file_get_contents($logFile);
$booksArray = json_decode($arrayOfBooks, true);
$byGenre = array();
foreach ($booksArray as $key => $jsons) { 
  array_push($byGenre, array($jsons["genre"],$jsons["title"]));
}
bookByGenre($byGenre);

function bookByGenre($arrays) {
  foreach ($arrays as $key) {

    echo "<script> var div = document.createElement('div'); div.style.color='white'; div.innerHTML =  ". json_encode($key[1]) . "\n" ."; document.getElementById(".json_encode($key[0]) . ").appendChild(div) ";
    echo "</script>";
}
}

?>