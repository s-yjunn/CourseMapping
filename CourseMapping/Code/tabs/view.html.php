<!-- <form action="php/jsonToTable.php" method="post">
<select name = "major">
    <option value="None">Select Majors</option>
    <option value="EGR">EGR</option>
    <option value="PHY">PHY</option>
</select>
<input type="submit" value="Submit the form"/>
</form> -->


<!--?php
// $content = file_get_contents("json/courses.json");
// $content_json = json_decode($content, true);
// echo "<form action=\"php/jsonToTable.php\" method=\"post\">";
// echo "<select name = \"major\">";
// echo $content_json[1];
// for($i = 1; $i < count(array_keys($content_json)); $i++){
//         echo "<option value=" . $content_json[$i]. ">". $content_json[$i]. "</option>";
//     };

//     // Close the table
// echo "</select>";
// echo "<input type=\"submit\" value=\"Select\"/>";
// ?> -->

<html lang="en"> 
  
<head> 
    <meta charset="UTF-8"> 
    <title>Course List</title> 
  
    <!-- INCLUDING JQUERY-->
    <script src= 
"https://code.jquery.com/jquery-3.5.1.js"> 
    </script> 
  
    <!-- CSS FOR STYLING THE PAGE -->
    <style> 
        table { 
            margin: 0 auto; 
            font-size: large; 
            border: 1px solid black; 
        } 
  
        h1 { 
            text-align: center; 
            color: #006600; 
            font-size: xx-large; 
            font-family: 'Gill Sans',  
                'Gill Sans MT', ' Calibri',  
                'Trebuchet MS', 'sans-serif'; 
        } 
  
        td { 
            background-color: #E4F5D4; 
            border: 1px solid black; 
        } 
  
        th, 
        td { 
            font-weight: bold; 
            border: 1px solid black; 
            padding: 10px; 
            text-align: center; 
        } 
  
        td { 
            font-weight: lighter; 
        } 
    </style> 
</head> 
  
<body> 
<section> 
<h1>View</h1> 
<select id = "major">
<option value="None">Select Majors</option>
<script> 
$(document).ready(function () { 
    $.getJSON("json/courses.json", function (data) { 
        var major = ''; 
        $.each(data, function (key, value) { 
            major += '<option value =' + key + '>' + key + '</option>'; 
        }); 
        $('#major').append(major); 
    }); 
}); 
</script> 
</select>

<table id='table'> 
<tr> 
    <th>Courses</th> 
    <th>Prerequisites</th> 
</tr> 

<script> 
$('#major').change(function () { 
    var major = $('#major option:checked').val();
    $.getJSON("json/courses.json", function (data) { 
        var course = ''; 
        $.each(data.major, function (key) { 
            $.each(key, function (k, v) { 
                course += '<tr>'; 
                course += '<td>' +  
                k + '</td>';  
                course += '</tr>'; 
            }); 
        }); 
        $('#table').append(course); 
    }); 
}); 
</script> 

</section> 
</body> 
</html>