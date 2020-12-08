<?php
/* 
@author Hyana Kang
The code is modified from login.php that we've learned in class
*/

//gets the input data from register.html and adds it to users.json
$id = $_POST['username'];
$pw = $_POST['password'];


$file = "../json/users.json";
$temp_json = json_decode(file_get_contents($file), true);

$available = 1;

// if the id is already taken, say it's not available
for($i=0; $i<count($temp_json); $i++) {    
    if($temp_json[$id]){
        $available = 0;
    }
}

// cannot register with admin's id
if($id == '220'){
    echo '<script type = "text/javascript">
    alert("You cannot register with this username! Please try other usernames");
    window.location.href="../index.html.php";
    </script>';
}

//add new user data to users.json
if($available == 1){
    ob_start();
    session_start();
    $new_data = array('id'=>count($temp_json), 'pw'=>$pw);
    $temp_json[$id] = $new_data;
    $_SESSION['username'] = $id;
    session_write_close();
    echo '<script type = "text/javascript">
    alert("Successfully Registered!");
    window.location.href="../index.html.php";
    </script>';
} else {
    echo '<script type = "text/javascript">
    alert("Your username is already in use! Please try other usernames.");
    window.location.href="../index.html.php";
    </script>';
}

file_put_contents($file, json_encode($temp_json));
?>
