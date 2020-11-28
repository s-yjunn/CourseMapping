$(document).ready(function () { 
    $.getJSON("json/users.json", function (data) { 
        var user = '';
        $.each(data, function (key, value) { 
            user += '<tr>'; 
            user += '<td>' + value.id + '</td>'; 
            user += '<td>' + key + '</td>'; 
            user += '<td>' + value.pw + '</td>';
            user += '<td> <input type=\"checkbox\" name = \"user[]\"'; 
            user += 'id= \"user\" value =\"' + key + '\"></td>'; 
            user += '</tr>'; 
        }); 
        $('#userTable').append(user); 
    }); 
}); 