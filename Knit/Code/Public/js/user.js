/* This file contains functions related to user accounts
* @author Isabel
*
*/

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

// This function sends a get request to change the user's profile in the json (right now just 'about') and updates the editProfile div
function editProfile(username, field) {
    if (field == "about") {
        var abt = $("#abtEdit").val().trim();
        $.ajax({
            type: "POST",
            url: "php/user/editProfile.php",
            data:{uname: username, about: abt},
            success: function() {
                $('#uPrDiv').html("Your changes have been saved.");
                $('#abtStatic').html(abt.replace(/(?:\r\n|\r|\n)/g, '<br>'));
                hide('editAbout');
            }
        });
    } else if (field == "pfp") {
        $('#uPrDiv').html("Your changes have been saved.");
        hide('editPfp');
    }
}

// Cancels the current profile edit by hiding the "field" div and restoring the default 'view' message
function cancelUPEdit(field) {
    $('#uPrDiv').html("This is what other users see when they click on your username in the forum and/or contest pages.");
    hide(field);
}