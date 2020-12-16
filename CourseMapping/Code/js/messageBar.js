/**
 * @author Allison Brand
 * 
 */

 /**
  * Displays message to user in messageBar from top of screen.
  * Shows message for ~3 seconds.
  * 
  * @param {string} message 
  */
 function showMessage(message) {
    var messageBar = document.getElementById("messagebar");
    messageBar.innerHTML = message;
    messageBar.className = "show";
    // After 3 seconds, remove the show class from messageBar
    setTimeout(function(){messageBar.className = messageBar.className.replace("show", ""); }, 3000);
 }