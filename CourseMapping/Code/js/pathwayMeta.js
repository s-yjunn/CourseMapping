//file paths:
var savepath = "users/save.php";

// Returns the server's response as to whether the save was successful.
// If tabID is given, save the pathway with that as it's key in sessionStorage
// If not, use the global variable currentTab
function save(tabID) {
    var success;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          success = xhttp.responseText;
          // Add message to message bar, and show it for ~3 seconds:
          var messageBar = document.getElementById("messagebar");
          messageBar.innerHTML = success;
          messageBar.className += "show";
          // After ~3 seconds, remove the show class from messageBar
          setTimeout(function(){messageBar.className = messageBar.className.replace("show", ""); }, 3500);
        }
    };
    xhttp.open("POST", savepath, true);
    xhttp.setRequestHeader("Content-type", "application/json");
    if(tabID) {
        var pathway = sessionStorage[tabID];
    } else {
        var pathway = sessionStorage[currentTab];
    }
    xhttp.send(pathway);
    return success;
  }

// Hides the title header and puts up a text input in it's place.
function titleChange(titleElement) {
    var currentTabDiv = document.getElementById(currentTab);
    var formDiv = currentTabDiv.getElementsByClassName("titleChanger")[0]; // There will only be one in a tab div, so the first one is it.
    titleElement.style.display = "none";
    formDiv.style.display = "block";

    // When the user clicks anywhere outside of the title changer input, close it
    window.onclick = function(event) {
        // If it is not formDiv or one of formDiv's children / grandchildren (it doesn't go further),
        // And it is not the titleElement that was used to open formDiv,
        // Then close formDiv 
        if (event.target != formDiv && 
         event.target.parentNode != formDiv && 
         event.target.parentNode.parentNode != formDiv &&
         event.target != titleElement) {
            titleElement.style.display = "block";
            formDiv.style.display = "none";
        }
    }
}

// Takes the user input, makes that the new title
// Updates the stored pathway to match.
function changeTitle(formElement) {
    var currentTabDiv = document.getElementById(currentTab);
    var titleElement = currentTabDiv.getElementsByClassName("pathwayTitle")[0]; // There will only be one in a tab div, so the first one is it.
    var tablink = document.getElementById("link_" + currentTab);
    // User end: update visual title
    titleElement.innerHTML = formElement["newTitle"].value;
    tablink.innerHTML = formElement["newTitle"].value;
    titleElement.style.display = "block";
    formElement.style.display = "none";
    // Controller: Update the stored title
    var pathway = JSON.parse(sessionStorage[currentTab]);
    pathway.title = formElement["newTitle"].value;
    sessionStorage[currentTab] = JSON.stringify(pathway);
}  