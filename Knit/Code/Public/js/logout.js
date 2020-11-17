function logOut() {
    $.ajax({
        type: "PUT",
        url: "php/logout.php",
        success: function(){
            // Leave a message up top
            $('#loggedIn').html("You have been logged out.");
            // get rid of the account tab link
            $('.account').hide();
            // reload the forum tab (so they can no longer post, vote, etc.)
            $("#Forum").load(location.href+" #Forum>*","");
            // go back to the home page
            openTab(event, "Welcome");
        }
    })
}