/**
 * @author Hyana Kang
 */
$(document).ready(function () { 
    /* it will collects the course information of selected major from courses.json 
    and adds it to the table in viewCourses.html*/
    $.getJSON("json/users.json", function (data) { 
        $.each(data, function (key, value) { 
            var user = '';
            var dir = "users/u_" + value.id;
            $.ajax({ url: 'php/admin/countFiles.php',
                    data: {'directory': dir},
                    type: 'POST',
                    success: function(data) {
                        user += '<tr>'; 
                        user += '<td>' + key + '</td>'; 
                        user += '<td>' + value.pw + '</td>'; 
                        user += '<td>' + value.id + '</td>'; 
                        user += '<td>' + data + '</td>'; 
                        user += '<td> <input type=\"checkbox\" name = \"dir[]\"'; 
                        user += 'id= \"dir\" value =\"u_' + value.id + '\"></td>'; 
                        user += '</tr>'; 
                        $('#userTable').append(user); 
                    },
                    error: function(){
                        alert("fail to load php");
                    }
            }); 
        }); 
}); 
}); 
