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
    if(typeof tabID !== 'undefined') {
        var pathway = sessionStorage[tabID];
    } else {
        var pathway = sessionStorage[currentTab];
    }
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var successResponse = xhttp.responseText;
          /* The success response is a string describing whether the save was successful in a human readable 
          way, and the last character is a flag that indicates whether it was a successul in a way which is 
          easy for the computer to parse.
          */
          if (successResponse.slice(-1) == "1") {
            if(typeof tabID !== 'undefined') {           
                sessionStorage[tabID]["serverSaveNeeded"] = false;
            } else {
                /* currentTab is being used
                 and serverSaveNeeded corresponds to the current tab, so it should be updated
                */
                serverSaveNeeded = false; 
                sessionStorage[currentTab]["serverSaveNeeded"] = serverSaveNeeded; 
            }
          }
          var success = successResponse.slice(0,-1);
          // Add message to message bar, and show it for ~3 seconds:
          showMessage(success);
          // TO ADD: Change color of message bar based on message.
        }
    };
    xhttp.open("POST", savepath, true);
    xhttp.setRequestHeader("Content-type", "application/json");

    xhttp.send(pathway);
  }

  