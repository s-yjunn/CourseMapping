<?php
/** 
    *@author Hyana Kang
    *https://www.tutorialspoint.com/php/php_login_example.html
    *The code is slightly modified from tutorialspoint
*/
session_start();
$_SESSION = array();
session_destroy();
header("Location: ../../index.html.php");
?>