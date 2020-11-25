$(document).ready(function () {
    $("#logoutButton2").click(function() {
        $.ajax({
            url: 'General/php/logout-main.php?argument=logOut',
            success: function(){
                window.location.reload();
            }
        });
    });
});