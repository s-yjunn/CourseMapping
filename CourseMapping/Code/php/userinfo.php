<?php
if(isset($_SESSION['username']) && ($_SESSION['username']!= 'admin')){
    echo $_SESSION['username']. " is a current user!";
    echo "<form action = 'php/logout.php'>
    <button class='logout-btn' onclick='clearUser()'>LOG OUT</button></form>";
} else if($_SESSION['username']== 'admin'){
    echo "You are an admin!";
    echo "<form action = 'php/logout.php'>
    <button class='logout-btn'>LOG OUT</button></form>";
} else {
    echo "You are a guest! If you want to see more features, please login!";
}
?>