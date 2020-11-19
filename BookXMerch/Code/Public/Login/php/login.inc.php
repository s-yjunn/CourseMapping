<?php


session_start();
$email = $_POST["email"];
$password = $_POST["pwd"];

$usersJSON = file_get_contents("../../../Private/Users/allUsers.JSON");
$rows= json_decode($usersJSON, true);

echo "<br>";

$user_auth = false;
$wrong_psw = false;
$name = "";

foreach ($rows as $key => $jsons) { 
    foreach($jsons as $key => $value) { 
        if($email == $value['email'] && $password == $value['password']) {
            $name = $value['name']; 
            $user_auth = true;
        } elseif ($email == $value['email'] && $password != $value['password']) {
            $user_auth = false;
            $wrong_psw = true;
        }
    }
}

if($user_auth) {
    echo "Welcome " . $name ."!" . "<br/>" . "You have successfully logged in!";
    if(!isset($_SESSION["name"])) { 
        $_SESSION["name"] = $name;
        echo "<br>" . "You are logged in as: " . $_SESSION["name"] . ". Hi!";
        // echo "<style type='text/css'> 
        // #Heading-User {
        //     display = block;
        // }
        // </style>";
        header("location: ../../../Private/Books/collection.php");
    }
} elseif($wrong_psw) {
    echo "Incorrect Password! Please try again.";
    header("location: ../login.php");
} else {
    echo "User with those login credentials does not exist. Please register first.";
    header("location: ../login.php"); 
}

?>

