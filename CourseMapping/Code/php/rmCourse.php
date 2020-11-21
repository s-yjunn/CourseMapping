<?php

$courses = $_POST['course'];

$file = "../json/courses.json";
$temp_json = json_decode(file_get_contents($file), true);

foreach ($courses as $course){ 
    $dep = explode(" ", $course)[0];
    if($temp_json[$dep][$course]){
        unset($temp_json[$dep][$course]);
    }
}

file_put_contents($file, json_encode($temp_json));

echo '<script type = "text/javascript">
    window.location.href="../admin.html.php";
</script>';

?>