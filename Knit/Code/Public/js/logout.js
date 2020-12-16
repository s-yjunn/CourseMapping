/* This script handles the client-side of logging out
@author Isabel */

function logOut() {
    // call on logout.php
    $.ajax({
        type: "PUT",
        url: "php/logout.php",
        success: function(){
            // once done, reload the page
            window.location.reload();
        }
    })
}