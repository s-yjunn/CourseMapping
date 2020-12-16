<?php
/**
*@author Hyana Kang
*The code is modified from login.php that we've learned in class
*/

//gets the input data from viewCourses.html and removes the corresponding data from courses.json
$courses = $_POST['course'];

$file_course = "../../json/courses.json";

$temp_json_course = json_decode(file_get_contents($file_course), true);

foreach ($courses as $course){ 
    //extracts the department
    $dep = explode(" ", $course)[0];
    if($temp_json_course[$dep][$course]){
        //remove!
        unset($temp_json_course[$dep][$course]);
    }
}

file_put_contents($file_course, json_encode($temp_json_course));

header("Location: ../../admin.html.php");
?>