function logOut() {
    $.ajax({
        type: "PUT",
        url: "php/logout.php",
        success: function(){
            // Leave a message up top
            $('#loggedIn').html("You have been logged out.");
            // get rid of the account tab links
            $("#accountTabs").load(location.href+" #accountTabs>*","");
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