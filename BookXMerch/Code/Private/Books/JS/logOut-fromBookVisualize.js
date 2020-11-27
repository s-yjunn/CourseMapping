$(document).ready(function () {
    $("#logoutButton").click(function() {
        $.ajax({
            url: '../php/logout.php?argument=logOut',
            success: function(data){
                window.location.href = "../../../Public/index.php";
            }
        });
    });
});