<?php
/** 
    *@author Hyana Kang
*/

//displays the user info on the top of the screen

// for registered users: 
if(isset($_SESSION['username']) && ($_SESSION['username']!= '220')){
    echo "<div style = 'width:100%'> <div class = 'loginBar'>";
    echo $_SESSION['username']. " is a current user! <form action = 'php/login/logout.php'>
    <button class='logout-btn' onclick='clearUser()'>LOG OUT</button></form>";
    echo "</div></div>";
// for admin:
} else if($_SESSION['username']== '220'){
    echo "<div style = 'width:100%'> <div class = 'loginBar'>";
    echo "You are an admin!<form action = 'php/login/logout.php'>
    <button class='logout-btn' >LOG OUT</button></form>";
    echo "</div></div>";
// for guest:
} else {
    echo "<div style = 'width:100%'> <div class = 'loginBar'>";
    echo "You are a guest! If you want to see more features, please login!";
    echo "</div></div>";
}
?>