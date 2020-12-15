/* This file contains functions related to user accounts
* @author Isabel
*
*/

// This function "opens" a user profile in the "to" div and hides the "from" div
function openProfile(username, to, from, fromLink) {
    // console.log(username + "'s profile opened from " + from);
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
    // clear any past messages
    $("#uPaDiv" + index).html("");
    // show save options
    show("patternEdit" + index);
}

// This function restores a pattern view div after the user cancels their edits
function cancelPatEdit(index) {
    $("#tag" + index).html($("#prevTag" + index).html());; //restore privacy indicator to previous value
    // restore page alert to its previous value
    $("#uPaDiv").html("Here are your saved patterns. Click on a pattern to view more options (download, edit privacy level).");
    // hide the save options
    hide("patternEdit" + index);
    // and the manage div in question
    hide("managePattern" + index);
}

// This function saves a modification to a pattern's privacy level
function savePatEdit(username, index) {
    // get the new visibility level
    var newPubPr = $("#tag" + index).html();
    // and the previous one
    var oldPubPr = $("#prevTag" + index).html();
    // see if a substantive change is being made
    if (newPubPr == oldPubPr) {
        // if not, we can call it a day
        hide("patternEdit" + index);
        $("#uPaDiv" + index).html("<p class='alert alert-info' role='alert'>Your change was saved.</p>");
    } else {
        // if so, send it to the php script
        $.ajax ({
            type: "POST",
            url: "php/user/editPattern.php",
            data: {uname: username, index: index, new: newPubPr},
            success: function(response) {
                // when done, hide the save options
                hide("patternEdit" + index);
                // if successful,
                if (response == 1) {
                    // let the user know
                    $("#uPaDiv" + index).html("<p class='alert alert-info' role='alert'>Your change was saved.</p>");
                    // update prevTag
                    $("#prevTag" + index).html(newPubPr);
                    // update profile edit page
                    $("#userProfile").load(location.href+" #userProfile>*","");
                // otherwise
                } else {
                    // restore the visibility tag to its previous value;
                    $("#tag" + index).html($("#prevTag" + index).html());
                    // let the user know
                    $("#uPaDiv" + index).html("<p class='alert alert-danger' role='alert'>Unable to save change.</p>");
                }
            }
        });
    }
}

// this function prepares to delete a pattern
function showPatDelete(username, index) {
    $("#deletePatBtn").attr("onclick","deletePattern('" + username + "', " + index + ")");
    hide("managePattern" + index);
    show("deletePattern");
}

// this function handles the client-side of deleting a user's pattern
function deletePattern(username, index) {
    // send it to the php script
    $.ajax ({
        type: "POST",
        url: "php/user/deletePattern.php",
        data: {uname: username, index: index},
        success: function(response) {
            // if something went wrong,
            if (response == 0) {
                // let the user know
                $("#uPaDiv").html("<p class='alert alert-danger' role='alert'>Unable to delete pattern.</p>");
            // otherwise,
            } else {
                // refresh this list of patterns
                $("#userPatternList").load(location.href+" #userPatternList>*","");
                // if the pattern was public,
                if (response == "Public") {
                    // also refresh the user profile page
                    $("#userProfile").load(location.href+" #userProfile>*","");
                }
                // let the user know
                $("#uPaDiv").html("<p class='alert alert-info' role='alert'>Your pattern was deleted.</p>");
            }
            // hide the deletion div regardless
            hide("deletePattern");
        }
    });
}

// this function loads the user's inbox (first open)
function openUserInbox(uname) {
    $("#userInbox").load("php/user/userInbox.php?uname=" + uname, function(){
        hide("userHome");
        show("userInbox");
    });
}

// this function updates the user's inbox
function refreshUserInbox(uname) {
    $("#userInbox").load("php/user/userInbox.php?uname=" + uname);
}