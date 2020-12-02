<?php
    //gets the input data from add.html and adds it to courses.json
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
    // $temp_json_major = json_decode(file_get_contents($file_major), true);
    $temp_json_course = json_decode(file_get_contents($file_course), true);

    $string = $major . " " . strval($num);
    
    
    $new_data = array(
    'prereqs'=>explode(", ", $prereqs),
    'coreqs'=>explode(", ", $coreqs),
    'requiredFor'=>explode(", ", $reqfor),
    'suggestedFor'=>explode(", ", $sugfor),
    'info'=>array('credits'=>intval($credit), 'title'=>$title),
    'overlap'=>explode(", ", $overlap)
    );
    
    $temp_json_course[$major][$string] = $new_data;

    // $new_index = count($temp_json_major[$major]["major"]["singular"]);
    // $temp_json_major[$major]["major"]["singular"][$new_index] = $string;

    file_put_contents($file_course, json_encode($temp_json_course));
    // file_put_contents($file_major, json_encode($temp_json_major));

    echo '<script type = "text/javascript">
        window.location.href="../../admin.html.php";
    </script>';
?>