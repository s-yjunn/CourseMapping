<?php
    $major = $_POST['major'];
    $num = $_POST['num'];
    $title = $_POST['title'];
    $credit = $_POST['credit'];
    $prereqs = $_POST['prereqs'];
    $coreqs = $_POST['coreqs'];
    $reqfor = $_POST['reqfor'];
    $sugfor = $_POST['sugfor'];
    $overlap = $_POST['overlap'];

    
    $file = "../json/courses.json";
    $temp_json = json_decode(file_get_contents($file), true);
    
    $string = $major . " " . strval($num);
    
    // for($i=0; $i<count($temp_json[$major]); $i++) {    
    //     $course = $temp_json[$major][$i];
    //     if($string == $course){
    //         $available = 0;
    //     }else if ($id == "220"){
    // //         $available = 0;
    // //     }
    // // }
    
    $new_data = array(
    'prereqs'=>explode(", ", $prereqs),
    'coreqs'=>explode(", ", $coreqs),
    'requiredFor'=>explode(", ", $reqfor),
    'suggestedFor'=>explode(", ", $sugfor),
    'info'=>array('credits'=>intval($credit), 'title'=>$title),
    'overlap'=>explode(", ", $overlap)
    );
    
    $temp_json[$major][$string] = $new_data;

    file_put_contents($file, json_encode($temp_json));

    echo '<script type = "text/javascript">
        window.location.href="../admin.html.php";
    </script>';
?>