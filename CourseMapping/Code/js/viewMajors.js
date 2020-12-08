/**
 * @author Hyana Kang
 */
// collects the departments from courses.json using jquery and adds them to the #majorCourse dropdown in viewCourses.html
$(document).ready(function () { 
    $.getJSON("json/majors.json", function (data) { 
        var major = ''; 
        $.each(data, function (key, value) { 
            if (key != "meta"){
                major += '<option value =' + key + '>' + key + '</option>'; 
            }
        }); 
        $('#majorCourse').append(major); 
    }); 
}); 

// if dropdown menu is changed, it will empty the table displaying the previous corresponding courses
$('#majorCourse').change(function () { 
    var items = $("#majorTable tr"); 
    for (let i = 1; i < items.length; i++) { 
        items[i].remove(); 
    } 
    /* it will collects the course information of selected major from courses.json 
    and adds it to the table in viewCourses.html*/
    var major = $('#majorCourse option:checked').val();
    $.getJSON("json/majors.json", function (data) { 
        var course = '';
        $.each(data[major]["major"]["singular"], function (key, value) { 
            course += '<tr>'; 
            course += '<td>' + value + '</td>'; 
            course += '<td> <input type=\"checkbox\" name = \"major[]\"'; 
            course += 'id= \"major\" value =\"' + value +'+'+ major + '\"></td>'; 
            course += '</tr>'; 
        }); 
        $('#majorTable').append(course); 
    }); 
}); 