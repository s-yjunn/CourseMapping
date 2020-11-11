<?php

function fOpenRequest($url) {
  $file = fopen($url, 'r');
  $data = stream_get_contents($file);
  fclose($file);
  return $data;
}

$target_dir = "../images/contest/";
if(!is_dir($target_dir)){
  mkdir($target_dir);
}
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
  'window.location.href = "../index.php";',
  '</script>';

}

for($i = 0; $i < $countfiles; $i++){
  $filename = $_FILES['fileToUpload']['name'][$i];
$target_file = $target_dir . basename($filename);
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if($fileType == 'txt') {
  $file = "../temp/" . basename($filename);
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $file)) {

    $desc = file_get_contents("../temp/" . basename($filename));

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
  'window.location.href = "../index.php";',
  '</script>';

}

}

if($txtPresent && $imgPresent){

$newData = array();
    $newSub = array(
      "username"   => "Anonymous",
      "image" => $image,
      "description" => $desc
    );
    
    $subs = file_get_contents("../json/contestSubs/submissions.json");

    $currentData = json_decode($subs, true);

    array_push($currentData,$newSub);

    $jsondata = json_encode($currentData, true);

    file_put_contents("../json/contestSubs/submissions.json", $jsondata);

    echo '<script language="javascript">',
     'alert("Your submission has been uploaded.");',
     'window.location.href = "../index.php";',
     '</script>';

  }

  else{

    echo '<script language="javascript">',
     'alert("Error! Text file or image not present.");',
     'window.location.href = "../index.php";',
     '</script>';

  }

?>