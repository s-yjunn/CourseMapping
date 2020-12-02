<?php 
//displays the tabs when the user is logged-in
if ((isset($_SESSION['username'])) && ($_SESSION['username']!= '220')){ 
        echo "style = 'display:block;'";} else {
        echo "style = 'display:none;'";
}
?>