<?php 
if ((isset($_SESSION['username'])) && ($_SESSION['username']!= 'admin')){ 
        echo "style = 'display:block;'";} else {
        echo "style = 'display:none;'";
}
?>