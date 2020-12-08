<?php 
/* 
@author Hyana Kang
*/
//displays the tabs when the user is logged-out
if (!isset($_SESSION['username'])){ 
        echo "style = 'display:block;'";} else {
        echo "style = 'display:none;'";
} 
//displays the tabs when the admin is logged-in
if ($_SESSION['username']=='220'){ 
    echo "style = 'display:block;'";} else {
    echo "style = 'display:none;'";
}
?>