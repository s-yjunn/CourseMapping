<?php 
if (!isset($_SESSION['username'])){ 
        echo "style = 'display:block;'";} else {
        echo "style = 'display:none;'";
} 
if ($_SESSION['username']=='admin'){ 
    echo "style = 'display:block;'";} else {
    echo "style = 'display:none;'";
}
?>