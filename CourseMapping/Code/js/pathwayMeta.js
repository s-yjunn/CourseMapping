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
// Updates the window onclick event listener to close the current tab's title input, and update the title if needed. 
function titleChange(titleElement) {
    var currentTabDiv = document.getElementById(currentTab);
    var formDiv = currentTabDiv.getElementsByClassName("titleChanger")[0]; // There will only be one in a tab div, so the first one is it.
    titleElement.style.display = "none";
    formDiv.style.display = "block";
    console.log(formDiv);
    console.log( formDiv.style.display);

    // When the user clicks anywhere outside of the title changer input, close it
    window.onclick = function(event) {
        // If it is not formDiv or one of formDiv's children / grandchildren (it doesn't go further),
        // And it is not the titleElement that was used to open formDiv,
        // Then close formDiv 
        if (event.target != formDiv && 
         event.target.parentNode != formDiv && 
         event.target.parentNode.parentNode != formDiv &&
         event.target != titleElement) {
            changeTitleHelper(titleElement, formDiv.children[0]); // The only child in formDiv is the form
        }
    }
}

// Takes the user input, makes that the new title
// Updates the stored pathway to match.
function changeTitle(formElement) {
    var currentTabDiv = document.getElementById(currentTab);
    var titleElement = currentTabDiv.getElementsByClassName("pathwayTitle")[0]; // There will only be one in a tab div, so the first one is it.
    changeTitleHelper(titleElement, formElement);
}  

// Takes both the form element and the title element,
// And the caller can pass what is already available, and search for the one that isn't available
function changeTitleHelper(titleElement, formElement) {
    var newTitle = formElement["newTitle"].value;
    if(newTitle) { // If it is defined, change the title
        console.log("\"" +  newTitle);
        // User end: update visual title
        var tablink = document.getElementById("link_" + currentTab);
        titleElement.innerHTML = newTitle;
        tablink.innerHTML = newTitle;
        // Controller: Update the stored title
        currentPathway.title = newTitle;
        sessionStorage[currentTab] = JSON.stringify(currentPathway);
    }
    // Either way, switch back to the tile element
    titleElement.style.display = "block";
    formElement.style.display = "none";
} 

