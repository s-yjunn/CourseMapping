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
// pfp processing code adapted from https://makitweb.com/how-to-upload-image-file-using-ajax-and-jquery/
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
    } else {
        console.log("something's wrong.");
    }
}

// Cancels the current profile edit by hiding the "field" div and restoring the default 'view' message
function cancelUPEdit(field, ogValue) {
    $('#uPrDiv').html("This is what other users see when they click on your username in the forum and/or contest pages.");
    hide(field);
}

// This function toggles the "PUBLIC/PRIVATE" fields in the profile viewing divs
function togglePubPr(toggleElm, index) {
    if (toggleElm.innerHTML == "Public") {
        toggleElm.innerHTML = "Private";
    } else if (toggleElm.innerHTML == "Private") {
        toggleElm.innerHTML = "Public";
    }
    show("patternEdit" + index);
}

// This function restores a pattern view div after the user cancels their edits
function cancelPatEdit(index, pubPr) {
    $("#tag" + index).html(pubPr); //restore privacy indicator to original value
    // restore page alert to original value
    $("#uPaDiv").html("Here are your saved patterns. Click on a pattern to view more options (download, edit privacy level).");
    // hide the save options
    hide("patternEdit" + index);
    // and the manage div in question
    hide("managePattern" + index);
}

// This function saves a modification to a pattern's privacy level
function savePattern(username, index) {
    var newPubPr = $("#tag" + index).html();
    $.ajax ({
        type: "POST",
        url: "php/user/editPattern.php",
        data: {uname: username, index: index, new: newPubPr},
        success: function(response) {
            if (response == 1) {
                $("#uPaDiv").html("Your change was saved.");
                // update profile edit page
                $("#userProfile").load(location.href+" #userProfile>*","");
            } else {
                $("#tag" + index).html(response);
                $("#uPaDiv").html("Unable to save change.");
            }
        }
    });
    // hide the save options
    hide("patternEdit" + index);
    // and the manage div in question
    hide("managePattern" + index);
}