//Author: Imane 
//Date: Dec 1st, 2020
$(document).ready(function () {
    $("#logoutButton4").click(function() {
        $.ajax({
            url: '../../Public/General/php/logout-main.php?argument=logOut',
            success: function(){
                window.location.href="../../Public/index.php";
            }
        });
    });
});