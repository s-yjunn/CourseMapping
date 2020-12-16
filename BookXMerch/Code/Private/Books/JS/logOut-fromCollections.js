// <!-- Author: Imane Berrada | Date: Nov 26th, 2020--> 
$(document).ready(function () {
    $("#logoutButton").click(function() {
        $.ajax({
            url: 'php/logout.php?argument=logOut',
            success: function(data){
                window.location.href = "../../Public/index.php";
            }
        });
    });
});