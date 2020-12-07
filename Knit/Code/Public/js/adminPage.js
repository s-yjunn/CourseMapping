/* This file contains functions related to the admin page
* @author Isabel
* Last modified 12/7/2020
*/

// This function refreshes the page stats
function refreshAdminUsers() {
  $("#adminUsers").load(location.href+" #adminUsers>*","");
}

// this function handles the client-side of sending a message to a user
function messageUser(username) {
  console.log("Sending a message to " + username);
}