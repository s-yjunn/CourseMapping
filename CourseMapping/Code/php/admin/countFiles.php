<?php
/* 
@author Hyana Kang
*/
$dir = $_POST['directory'];
$dir = "../../" . $dir. "/";
$files = glob($dir . "*" ); 
$filecount = 0;
if($files) { 
    $filecount = count($files); 
} 
echo $filecount;
?>