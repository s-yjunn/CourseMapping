<?php
   ob_start();
   session_start();
?>

<?php

$id = $_POST['username'];
$pw = $_POST['password'];
$admin_id = "admin";
$admin_pw = "1234";

$login = 0;

$file = "../json/users.json";
$temp_json = json_decode(file_get_contents($file), true);

if ($id == $admin_id && $pw == $admin_pw){
    $admin_login = 1;
}

for($i=0; $i<count($temp_json['users']); $i++) {    
    $user_id = $temp_json['users'][$i]['id'];
    $user_pw = $temp_json['users'][$i]['pw'];
    if($id == $user_id && $pw == $user_pw){
        $login = 1;
    } 
}

if($login == 1){
    echo '<script type = "text/javascript">
    alert("Successfully Login!");
    window.location.href="../index.html.php";
    </script>';
    $_SESSION['username'] = $id;
    session_write_close();
} else if($admin_login == 1){
    echo '<script type = "text/javascript">
    alert("Successfully Login as Admin!");
    window.location.href="../index.html.php";
    </script>';
    $_SESSION['username'] = $id;
    session_write_close();
} else {
    echo '<script type = "text/javascript">
    alert("Wrong admin ID or password! Please try again!");
    window.location.href="../index.html.php";
    </script>';
}
?>
