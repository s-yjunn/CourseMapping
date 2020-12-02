<?php
//gets the input data from viewCourses.html and removes the corresponding data from courses.json
$courses = $_POST['course'];

$file_course = "../../json/courses.json";

$temp_json_course = json_decode(file_get_contents($file_course), true);

foreach ($courses as $course){ 
    //extracts the department from course number
    $dep = explode(" ", $course)[0];
    if($temp_json_course[$dep][$course]){
        //remove!
        unset($temp_json_course[$dep][$course]);
    }
}

file_put_contents($file_course, json_encode($temp_json_course));

echo '<script type = "text/javascript">
    window.location.href="../../admin.html.php";
</script>';

?>