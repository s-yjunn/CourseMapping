/* This file contains functions related to the admin page
* @author Isabel
* Last modified 12/6/2020
*/

// This function refreshes the page stats
function refreshAdminStats() {
  $("#adminStats").load(location.href+" #adminStats>*","");
}