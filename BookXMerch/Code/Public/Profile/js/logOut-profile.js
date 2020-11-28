$(document).ready(function () {
    $("#logoutButton3").click(function() {
        $.ajax({
            url: '../General/php/logout-main.php?argument=logOut',
            success: function(){
                window.location.href="../index.php";
            }
        });
    });
});