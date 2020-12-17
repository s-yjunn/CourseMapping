<?php
/* This is to upload a new submission
@author Bethany
Last modified 12/16/2020 */

//get target directory
$target_dir = "../imgs/contest/";
//if directory doesn't exist....
if(!is_dir($target_dir)){
  //....make it
  mkdir($target_dir);
}

//get submission info
$title = $_POST["title"];
$author = $_POST["author"];
$countfiles = count($_FILES['fileToUpload']['name']);
$fileType;
$desc = "";
$image = "";
//will use to check if user submitted one txt file and one img
$txtPresent = false;
$imgPresent = false;
//if user did not submit two files....
if($countfiles != 2){
//....show error msg
  echo '<script language="javascript">',
  'alert("Error! Please upload two files.");',
  'window.location.href = "../";',
  '</script>';

}
//loop over files
for($i = 0; $i < $countfiles; $i++){
  //get file name
  $filename = $_FILES['fileToUpload']['name'][$i];
  //get file path
$target_file = $target_dir . basename($filename);
//get file type
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
//if txt file....
if($fileType == 'txt') {
  //....save description
  $desc = file_get_contents($_FILES["fileToUpload"]["tmp_name"][$i]);
  //confirm txt file exists
  $txtPresent = true;
  continue;

}
//if file is an img... 
else if($fileType == 'jpg' || $fileType == 'png' || $fileType == 'gif'){
  //move file to directory
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file)) {
    //save img
    $image = $target_file;
    //confirm img exists
    $imgPresent = true;
    continue;
    
  }

}

else{
  //if there is an error, show msg:
  echo '<script language="javascript">',
  'alert("Sorry, your files were not uploaded. Please only upload one txt file and one image (jpg, png, gif)";',
  'window.location.href = "../";',
  '</script>';

}

}
//if user submitted img & txt
if($txtPresent && $imgPresent){
//save submission data
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
    //add data to json
    array_push($compData["submissions"],$newSub);
    $jsondata = json_encode($compData, true);
    file_put_contents("../data/contest.json", $jsondata);
    //confirm success
    echo '<script language="javascript">',
     'alert("Your submission has been uploaded.");',
     'window.location.href = "../";',
     '</script>';

  }

  else{
    //if user did not submit img & txt, show msg:
    echo '<script language="javascript">',
     'alert("Error! Text file or image not present.");',
     'window.location.href = "../";',
     '</script>';

  }

?>