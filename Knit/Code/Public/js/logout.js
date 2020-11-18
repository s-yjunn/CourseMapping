function logOut() {
    $.ajax({
        type: "PUT",
        url: "php/logout.php",
        success: function(){
            // Leave a message up top
            $('#loggedIn').html("You have been logged out.");
            // show and hide the proper tab links
            $("#loginTabs").load(location.href+" #loginTabs>*","");
            // clear the account divs
            $("#User").html("");
            $("#Admin").html("");
            // reload the forum tab (so they can no longer post, vote, etc.)
            $("#Forum").load(location.href+" #Forum>*","");
            // if in one of the account tabs
            if (currentTab === "Admin" || currentTab === "User") {
                // return to the homepage
                openTab(event, "Welcome");
            }
        }
    })
}