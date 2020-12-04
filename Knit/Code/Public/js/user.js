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

// This function sends a post request to change the user's profile in the json and updates the page accordingly
// pfp processing code adapted from first answer at https://stackoverflow.com/questions/166221/how-can-i-upload-files-asynchronously
function editProfile(username, field) {
    if (field == "about") {
        var abt = $("#abtEdit").val().trim();
        $.ajax({
            type: "POST",
            url: "php/user/editProfile.php",
            data:{uname: username, about: abt},
            success: function(response) {
                if (response != 0) {
                    if (abt != "") {
                        $('#abtStatic').html(abt.replace(/(?:\r\n|\r|\n)/g, '<br>'));
                    } else {
                        $('#abtStatic').html("This user hasn't added a bio.");
                    }
                    $('#uPrDiv').html("Your bio has been updated.");
                } else {
                    $('#uPrDiv').html("Unable to update bio.");
                }
                hide('editAbout');
            }
        });
    } else if (field == "pfp") {
        var files = $('#pfpFile')[0].files;
        // Check file selected or not
        if (files.length == 0 ){
            $("#pfpFeedback").html("<p class='alert alert-danger' role='alert'>Please select a file.</p>");
        // check file is an image
        } else if (files[0]['type'].split('/')[0] != 'image') {
            $("#pfpFeedback").html("<p class='alert alert-danger' role='alert'>Please select an image.</p>");
        // if all is well,
        } else {
            // create a new FormData element and add the stuff we want to it
            var fd = new FormData();
            fd.append('pfp', files[0]);
            fd.append('uname', username);

            // send the info to our php processing page
            $.ajax({
                type: 'POST',
                url: "php/user/editProfile.php",
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    // if update is successful,
                    if (response != 0){
                        // update display picture
                        $("#viewPfpImg").attr("src", response);
                        // output a success message
                        $("#uPrDiv").html("Your profile picture has been updated.");
                    } else {
                        // output a failure message
                        $("#uPrDiv").html("Unable to update profile picture.");
                    }
                    // clear upload input
                    $('#pfpFile').val("");
                    hide('editPfp');
                },
           });
        }
    }
}

// Cancels the current profile edit by hiding the "field" div and restoring the default 'view' message
function cancelUPEdit(field) {
    $('#uPrDiv').html("This is what other users see when they click on your username in the forum and/or contest pages.");
    hide(field);
}