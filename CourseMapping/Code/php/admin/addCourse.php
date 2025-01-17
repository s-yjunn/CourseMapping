<?php
/**
*@author Hyana Kang
*The code is modified from login.php that we've learned in class
*/
    //gets the input data from add.html and adds it to courses.json and majors.json
    $major = $_POST['major'];
    $num = $_POST['num'];
    $title = $_POST['title'];
    $credit = $_POST['credit'];
    $prereqs = $_POST['prereqs'];
    $coreqs = $_POST['coreqs'];
    $reqfor = $_POST['reqfor'];
    $sugfor = $_POST['sugfor'];
    $overlap = $_POST['overlap'];


    $file_course = "../../json/courses.json";
    $file_major = "../../json/majors.json";
    $temp_json_major = json_decode(file_get_contents($file_major), true);
    $temp_json_course = json_decode(file_get_contents($file_course), true);

    $string = $major . " " . strval($num);
    
    //will be added to courses.json
    $new_data = array(
    'prereqs'=>explode(", ", $prereqs),
    'coreqs'=>explode(", ", $coreqs),
    'requiredFor'=>explode(", ", $reqfor),
    'suggestedFor'=>explode(", ", $sugfor),
    'info'=>array('credits'=>intval($credit), 'title'=>$title),
    'overlap'=>explode(", ", $overlap)
    );
    $temp_json_course[$major][$string] = $new_data;

    // course itself, and its prereqs and coreqs of the course will be added to the department(majors.json)
    $prereq_array = explode(", ", $prereqs);
    foreach ($prereq_array as $prereq){
        if(!in_array($prereq, $temp_json_major[$major]["major"]["singular"], true)){
            $temp_json_major[$major]["major"]["singular"][] = $prereq;
        }
    }
    $coreq_array = explode(", ", $coreqs);
    foreach ($coreq_array as $coreq){
        if(!in_array($prereq, $temp_json_major[$major]["major"]["singular"], true)){
            $temp_json_major[$major]["major"]["singular"][] = $coreq;
        }
    }
    if(!in_array($string, $temp_json_major[$major]["major"]["singular"], true)){
        $temp_json_major[$major]["major"]["singular"][] = $string;
    }

    file_put_contents($file_course, json_encode($temp_json_course));
    file_put_contents($file_major, json_encode($temp_json_major));

    header("Location: ../../admin.html.php");
?>