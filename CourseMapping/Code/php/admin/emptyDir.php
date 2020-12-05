<?php
$folders = $_POST['dir'];
foreach ($folders as $folder){ 
    $dir = '../../users/' . $folder; 
    $files = glob($dir . "/*" ); 
    array_map('unlink', array_filter((array) array_merge($files))); 
}
header('Location: ../../admin.html.php');
?>