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

$('#majorCourse').change(function () { 
    var items = $("#majorTable tr"); 
    for (let i = 1; i < items.length; i++) { 
        items[i].remove(); 
    } 

    var major = $('#majorCourse option:checked').val();
    $.getJSON("json/majors.json", function (data) { 
        var course = '';
        $.each(data[major]["major"]["singular"], function (key, value) { 
            course += '<tr>'; 
            course += '<td>' + value + '</td>'; 
        }); 
        $('#majorTable').append(course); 
    }); 
}); 

var modal_add = document.getElementById('add');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
if (event.target == modal_add) {
    modal_add.style.display = "none";
}
}