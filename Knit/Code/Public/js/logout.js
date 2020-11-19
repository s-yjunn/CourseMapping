function logOut() {
    $.ajax({
        type: "PUT",
        url: "php/logout.php",
        success: function(){
            // once done, reload the page
            window.location.reload(true);
        }
    })
}