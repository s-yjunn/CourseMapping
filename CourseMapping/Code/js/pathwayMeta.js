/**
 * @author Allison Brand 
 */

// A flag for when the new title text input is actually open 
// Without this flag, the title of the current tab would be changed to whatever the last title change ended up being,
//   everytime the user clicks something outside the text input (which, again, isn't even up)
  var titleInputOpen = false; 

// Hides the title header and puts up a text input in it's place.
// Updates the window onclick event listener to close the current tab's title input, and update the title if needed. 
function titleChange(titleElement) {
    var currentTabDiv = document.getElementById(currentTab);
    var formDiv = currentTabDiv.getElementsByClassName("titleChanger")[0]; // There will only be one in a tab div, so the first one is it.
    titleElement.style.display = "none";
    formDiv.style.display = "block";

    titleInputOpen = true; 

    // When the user clicks anywhere outside of the title changer input, close it
    window.onclick = function(event) {
        // If it is not formDiv or one of formDiv's children / grandchildren (it doesn't go further),
        // And it is not the titleElement that was used to open formDiv,
        // Then close formDiv 
        if (titleInputOpen && 
         event.target != formDiv && 
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
// Sets the flag titleInputOpen to false;
function changeTitleHelper(titleElement, formElement) {
    var newTitle = formElement["newTitle"].value;
    if(newTitle) { // If it is defined, change the title
        // User end: update visual title
        var tablink = document.getElementById("link_" + currentTab);
        titleElement.innerHTML = newTitle;
        tablink.innerText = newTitle;
        // Controller: Update the stored title
        currentPathway.title = newTitle;
        sessionStorage[currentTab] = JSON.stringify(currentPathway);
    }
    // Either way, switch back to the tile element
    titleElement.style.display = "block";
    formElement.style.display = "none";

    titleInputOpen = false;
} 

