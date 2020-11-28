<?php

session_start();
$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["pwd"];
$username = $_POST['uname'];

$passwordRepeat = $_POST["pwdrepeat"];
$type = "user"; 

$arr_row = array(
    'name' => $name, 
    'email' => $email,
    'username' => $username, 
    'type' => $type,
    'password' => $password,
    'readingList' => []
);


$usersJSON = file_get_contents("../../../Private/Users/allUsers.JSON");
$rows= json_decode($usersJSON, true);

$user_exists = false;

foreach($rows as $key => $jsons) {
    foreach($jsons as $key => $value) { 
        if($value['email'] == $email) {
            $user_exists = true;
        }
    }
}

if($user_exists) {
    echo "You are already registered. Please login with original credentials. :)";
} elseif($password != $passwordRepeat) {
        echo "Passwords do not match!";
        exit(); 
} else {
    array_push($rows['users'], $arr_row); 
    $resJSON = json_encode($rows, JSON_PRETTY_PRINT);
    if(file_put_contents("../../../Private/Users/allUsers.JSON", $resJSON)) {
        echo "Registration Successful!" . "<br/>" . "<br/>". " Welcome, " . $name . "! <br>";
        $_SESSION['name'] = $name;
        $_SESSION['username'] = $username;
        // echo "<style>#Heading-User {
        //     display = 'block';
        // }</style>";
        header("location: ../../../Private/Books/collection.php");

    } else {
        echo "Invalid Entries. Please try again!";
        header("location: ../signup.php");
    }
}


?>