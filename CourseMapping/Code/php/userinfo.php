<?php
if(isset($_SESSION['username'])){
    echo $_SESSION['username']. " is a current user!";
    echo "<form action = 'php/logout.php'>
    <button>LOG OUT</button></form>";
    } else {
    echo "You are a guest! If you want to see more features, please login!";
    }
?>