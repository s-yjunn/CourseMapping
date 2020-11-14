<?php
if ($_SESSION['username']== 'admin'){ 
    echo "style = 'display:block;'";} else {
    echo "style = 'display:none;'";
}
?>