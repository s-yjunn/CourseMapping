<?php

$users = $_POST['user'];

$file = "../json/users.json";
$temp_json = json_decode(file_get_contents($file), true);

foreach ($users as $user){ 
    if($temp_json[$user]){
        unset($temp_json[$user]);
    }
}

file_put_contents($file, json_encode($temp_json));

echo '<script type = "text/javascript">
    window.location.href="../admin.html.php";
</script>';

?>