// This function "opens" a user profile in the "to" div and hides the "from" div
function openProfile(username, to, from, fromLink) {
    //console.log(username + "'s profile opened from " + from);
    // load the profile into the to div, then
    $("#"+to).load("php/user/profileStatic.php?uname=" + username + "&to=" + to + "&from=" + from + "&fromLink=" + fromLink, function(){
        // hide the from div
        hide(from);
        // show the profile
        show(to);
    });
}

// This function sends a get request to change the user's profile in the json (right now just 'about') and refreshes the editProfile divs
function saveProfile(username) {
    var abt = $("#editAbout").val().trim();
    $.ajax({
        type: "GET",
        url: "php/user/profileEdit.php",
        data:{uname: username, about: abt},
        success: function(result) {
            $('#userProfile').html(result);
            $('#upDiv').html("Your changes have been saved.");
            hide('editProfile');
            show('viewProfile');
        }
    });
}

// Cancels the current profile edit by hiding the edit div and restoring the default 'view' message
function cancelUPEdit() {
    $('#upDiv').html("This is what other users see when they click on your username in the forum and/or contest pages.");
    hide('editProfile');
    show('viewProfile');
}