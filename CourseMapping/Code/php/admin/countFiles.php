<?php
/* 
@author Hyana Kang
*/

// counts the number of files in each user's designated directory
$dir = $_POST['directory'];
$dir = "../../" . $dir. "/";
$files = glob($dir . "*" ); 
$filecount = 0;
if($files) { 
    $filecount = count($files); 
} 
echo $filecount;
?>