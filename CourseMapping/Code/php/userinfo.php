<?php
if(isset($_SESSION['username']) && ($_SESSION['username']!= 'admin')){
    echo "<div style = 'width:100%'> <div class = 'loginBar'>";
    echo $_SESSION['username']. " is a current user! <form action = 'php/logout.php'>
    <button class='logout-btn' onclick='clearUser()'>LOG OUT</button></form>";
    echo "</div></div>";
} else if($_SESSION['username']== 'admin'){
    echo "<div style = 'width:100%'> <div class = 'loginBar'>";
    echo "You are an admin!<form action = 'php/logout.php'>
    <button class='logout-btn'>LOG OUT</button></form>";
    echo "</div></div>";
} else {
    echo "<div style = 'width:100%'> <div class = 'loginBar'>";
    echo "You are a guest! If you want to see more features, please login!";
    echo "</div></div>";
}
?>