<?php 
$logFile = "../../../../Private/Merch/allMerch.JSON";

$category = $_REQUEST['category'];

$arrayOfMerch = file_get_contents(__DIR__ . "../../../../Private/Merch/allMerch.JSON");
$merchArray = (json_decode($arrayOfMerch, true));
//echo var_dump($merchArray);
$byCategory = array();

foreach ($merchArray as $key => $jsons) { 
  if($jsons["category"]==$category) {
    $newArray = array($jsons["category"],$jsons["item"],$jsons["inventory"],$jsons["points"],$jsons["url"]);
    array_push($byCategory, $newArray);
  }
}

echo "<div>";
foreach ($byCategory as $newArray) {
  echo "<ul>";
  echo "<b> <button class='fixedButton' onclick='displayContent(".$newArray[4].")' id='".$newArray[4]."'> " . $newArray[1] . "</button></b> ";
  echo "</ul>";
}
echo "</div>";
?>

