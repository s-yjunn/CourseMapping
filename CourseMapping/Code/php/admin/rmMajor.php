<?php
//gets the input data from viewCourses.html and removes the corresponding data from courses.json
$courses = $_POST['major'];

$file_major = "../../json/majors.json";

$temp_json_major = json_decode(file_get_contents($file_major), true);


foreach ($courses as $course){ 
    //extracts the department from course
    $course_info = explode("+", $course);
    if (($key = array_search($course_info[0], $temp_json_major[$course_info[1]]["major"]["singular"])) !== false) {
        unset($temp_json_major[$course_info[1]]["major"]["singular"][$key]);
    }
}

$temp_json_major[$course_info[1]]["major"]["singular"] = array_values($temp_json_major[$course_info[1]]["major"]["singular"]);

file_put_contents($file_major, json_encode($temp_json_major));

header("Location: ../../admin.html.php");
?>