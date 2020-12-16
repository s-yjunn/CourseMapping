/* This file contains functions related to the admin page
@author Isabel
Last modified 12/7/2020 */

// This function refreshes the page stats
function refreshAdminUsers() {
  $("#adminUserList").load(location.href+" #adminUserList>*","");
}

// this function prepares and opens the adminCompose div so an admin can send a message to a user
// to -- the message's intended recipient
// from -- the message's sender (currently logged in admin)
function showAdminCompose(to, from) {
  // Give the admin some customized guidance
  $("#msgToUser").attr("placeholder","Write your message to " + to);
  // Set the onclick to send the message to the right user
  $("#msgToUserBtn").attr("onclick","messageToUser('" + to + "', '" + from + "')");
  // Open the composition div
  show("adminCompose");
}

// This function clears out the composition div and closes it
function cancelAdminCompose() {
  // Close the composition div
  hide("adminCompose");
  // Clear the composition area
  $("#msgToUser").val("");
  // clear any previous feedback
  $("#msgToUserFeedback").html("");
}

// this function handles the client side of sending a message to a user
// to -- the message's intended recipient
// from -- the message's sender (currently logged in admin)
function messageToUser(to, from) {
  var message = $("#msgToUser").val().trim();
  if (message == "") {
    $("#msgToUserFeedback").html("<p class='alert alert-danger' role='alert'>Please enter a message.</p>");
  } else {
    // send the request to the processing file
    $.ajax({
      type: "POST",
      url: "php/admin/messageToUser.php",
      data: {text: message, to: to, from: from},
      success: function(response) {
        // if we get a failure message
        if (response == 0) {
          // let the admin know
          $("#msgToUserFeedback").html("<p class='alert alert-danger' role='alert'>Unable to send message.</p>");
          // if successful,
        } else {
          // let the admin know
          $("#msgToUserFeedback").html("<p class='alert alert-info' role='alert'>Your message to " + to + " was sent.</p>");
        }
        // Clear the composition area
        $("#msgToUser").val("");
      }
    });
  }
}

// this function loads the admin inbox (first open)
function openAdminInbox() {
  $("#adminInbox").load("php/admin/adminInbox.php", function(){
    hide("adminHome");
    show("adminInbox");
  });
}

// update the admin inbox {
function refreshAdminInbox() {
  $("#adminInbox").load("php/admin/adminInbox.php");
}