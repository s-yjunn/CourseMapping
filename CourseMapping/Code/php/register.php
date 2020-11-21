<?php

$id = $_POST['username'];
$pw = $_POST['password'];


$file = "../json/users.json";
$temp_json = json_decode(file_get_contents($file), true);

$available = 1;

for($i=0; $i<count($temp_json); $i++) {    
    if($temp_json[$id]){
        $available = 0;
    }
}

if($id == 'admin'){
    echo '<script type = "text/javascript">
    alert("You cannot register with this username! Please try other usernames");
    window.location.href="../index.html.php";
    </script>';
}

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
