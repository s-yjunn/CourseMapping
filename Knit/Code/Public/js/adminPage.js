/* This file contains functions related to the admin page
* @author Isabel
* Last modified 12/7/2020
*/

// This function refreshes the page stats
function refreshAdminUsers() {
  $("#adminUserList").load(location.href+" #adminUserList>*","");
}

// this function prepares and opens the adminCompose div so an admin can send a message to a user
// to -- the message's intended recipient
// from -- the message's sender (currently logged in admin)
function showAdminCompose(to, from) {
  // Give the admin some customized guidance
  $("#adminMsg").attr("placeholder","Write your message to " + to);
  // Set the onclick to send the message to the right user
  $("#sendMsgBtn").attr("onclick","sendMessage('" + to + "', '" + from + "')");
  // Open the composition div
  show("adminCompose");
}

// This function clears out the composition div and closes it
function cancelAdminCompose() {
  // Close the composition div
  hide("adminCompose");
  // Clear the composition area
  $("#adminMsg").val("");
  // clear any previous feedback
  $("#adminMsgFeedback").html("");
}

// this function handles the client side of sending a message to a user
// to -- the message's intended recipient
// from -- the message's sender (currently logged in admin)
function sendMessage(to, from) {
  var message = $("#adminMsg").val().trim();
  if (message == "") {
    $("#adminMsgFeedback").html("<p class='alert alert-danger' role='alert'>Please enter a message.</p>");
  } else {
    $.ajax({
      type: "POST",
      url: "php/admin/sendMessage.php",
      data: {text: message, to: to, from: from},
      success: function(response) {
        console.log(response);
        // clear everything out, and close the composition div
        cancelAdminCompose();
      }
    });
  }
}