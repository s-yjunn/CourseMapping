<!-- Author: Imane Berrada | Date: Nov 19th, 2020--> 
<?php 
$logFile = "../allBooks.JSON";

$genre = $_REQUEST['genre'];

$arrayOfBooks = file_get_contents("../allBooks.JSON");
$booksArray = json_decode($arrayOfBooks, true);
$byGenre = array();

foreach ($booksArray as $key => $jsons) { 
  if($jsons["genre"]==$genre) {
    $newArray = array($jsons["title"],$jsons["author"],$jsons["illustrator"],$jsons["description"],$jsons["url"],$jsons["rating"],$jsons["reviews"],$jsons["bookid"]);
    array_push($byGenre, $newArray);
  }
}

echo "<div>";
foreach ($byGenre as $newArray) {
  echo "<ul>";
  echo "<b> <button class='fixedButton' onclick='displayContent(".$newArray[7].")' id='".$newArray[7]."'> " . $newArray[0] . "</button></b> ";
  echo "</ul>";
}
echo "</div>";
?>


