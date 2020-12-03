/**
 * @author Allison Brand
 * 
 * Saves a pathway to the server, and shows the server's success message.
 */

 //file paths:
var savepath = "php/save.php";

// Displays  the server's response as to whether the save was successful.
// If tabID is given, save the pathway with that as it's key in sessionStorage
// If not, use the global variable currentTab
function save(tabID) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var success = xhttp.responseText;
          // Add message to message bar, and show it for ~3 seconds:
          var messageBar = document.getElementById("messagebar");
          messageBar.innerHTML = success;
          messageBar.className = "show";
          // After 3 seconds, remove the show class from messageBar
          setTimeout(function(){messageBar.className = messageBar.className.replace("show", ""); }, 3000);
        }
    };
    xhttp.open("POST", savepath, true);
    xhttp.setRequestHeader("Content-type", "application/json");
    if(typeof tabID !== 'undefined') {
        var pathway = sessionStorage[tabID];
    } else {
        var pathway = sessionStorage[currentTab];
    }
    xhttp.send(pathway);
  }

  