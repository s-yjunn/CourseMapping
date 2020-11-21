<html lang="en"> 
<head> 
<meta charset="UTF-8"> 
<title>Course List</title> 
<link rel="stylesheet" type="text/css" href="css/login_style.css">
<link rel="stylesheet" type="text/css" href="css/view.css">
<script src= "https://code.jquery.com/jquery-3.5.1.js"></script> 
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
            if (key != "meta"){
                major += '<option value =' + key + '>' + key + '</option>'; 
            }
        }); 
        $('#major').append(major); 
    }); 
}); 
</script> 
</select>

<form action="php/rmCourse.php" method = "POST">
<table id='table'> 
<tr> 
    <th>Courses</th> 
    <th>Title</th> 
    <th>Credit</th> 
    <th>Prerequisites</th> 
    <th>Corequisites</th> 
    <th>Required For</th> 
    <th>Suggested For</th> 
    <th>Overlap</th> 
    <th><input type="submit" value="REMOVE"></th> 
</tr> 
</form>

<script> 
$('#major').change(function () { 
    var items = $("#table tr"); 
    for (let i = 1; i < items.length; i++) { 
        items[i].remove(); 
    } 

    var major = $('#major option:checked').val();
    $.getJSON("json/courses.json", function (data) { 
        var course = '';
        $.each(data[major], function (key, value) { 
            course += '<tr>'; 
            course += '<td>' + key + '</td>'; 
            course += '<td>' + value.info.title + '</td>'; 
            course += '<td>' + value.info.credits + '</td>';
            course += '<td>' + value.prereqs + '</td>'; 
            course += '<td>' + value.coreqs + '</td>'; 
            course += '<td>' + value.requiredFor + '</td>'; 
            course += '<td>' + value.suggestedFor + '</td>'; 
            course += '<td>' + value.overlap + '</td>'; 
            course += '<td> <input type=\"checkbox\" name = \"course[]\"'; 
            course += 'id= \"course\" value =\"' + key + '\"></td>'; 
            course += '</tr>'; 
        }); 
        $('#table').append(course); 
    }); 
}); 
</script> 
</section>
</body> 
</html>