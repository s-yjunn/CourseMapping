/**
 * @author Hyana Kang
 */
// collects the departments from courses.json using jquery and adds them to the #major dropdown in viewCourses.html
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

// if dropdown menu is changed, it will empty the table displaying the previous corresponding courses
$('#major').change(function () { 
    var items = $("#courseTable tr"); 
    for (let i = 1; i < items.length; i++) { 
        items[i].remove(); 
    } 

    /* it will collects the course information of selected major from courses.json 
    and adds it to the table in viewCourses.html with a checkbox*/
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
        $('#courseTable').append(course); 
    }); 
}); 

// modal for add the course
var modal_add = document.getElementById('add');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
if (event.target == modal_add) {
    modal_add.style.display = "none";
}
}