<?php

$target_dir = "../imgs/contest/";
if(!is_dir($target_dir)){
  mkdir($target_dir);
}

$title = $_POST["title"];
$author = $_POST["author"];
$uploadOk = 1;
$countfiles = count($_FILES['fileToUpload']['name']);
$fileType;
$desc = "";
$image = "";
$txtPresent = false;
$imgPresent = false;
if($countfiles != 2){

  echo '<script language="javascript">',
  'alert("Error! Please upload two files.");',
  'window.location.href = "../";',
  '</script>';

}

for($i = 0; $i < $countfiles; $i++){
  $filename = $_FILES['fileToUpload']['name'][$i];
$target_file = $target_dir . basename($filename);
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if($fileType == 'txt') {
  $file = "../temp/" . basename($filename);
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $file)) {

    $desc = file_get_contents($file);

    unlink($file);

    $txtPresent = true;

  continue;

}} else if($fileType == 'jpg' || $fileType == 'png' || $fileType == 'gif'){
  

  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file)) {

    $image = $target_file;

    $imgPresent = true;
    
    continue;
    
  }

}

else{

  echo '<script language="javascript">',
  'alert("Sorry, your files were not uploaded. Please only upload one txt file and one image (jpg, png, gif)";',
  'window.location.href = "../";',
  '</script>';

}

}

if($txtPresent && $imgPresent){

$newData = array();
    $newSub = array(
      "title" => $title,
      "author"  => $author,
      "image" => basename($image),
      "text" => $desc,
      "votes" => 0
    );
    
    $comp = file_get_contents("../data/contest.json");
    $compData = json_decode($comp, true);

    array_push($compData["submissions"],$newSub);

    $jsondata = json_encode($compData, true);

    file_put_contents("../data/contest.json", $jsondata);

    echo '<script language="javascript">',
     'alert("Your submission has been uploaded.");',
     'window.location.href = "../";',
     '</script>';

  }

  else{

    echo '<script language="javascript">',
     'alert("Error! Text file or image not present.");',
     'window.location.href = "../";',
     '</script>';

  }

?>