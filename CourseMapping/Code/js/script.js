/**
 * @author Allison Brand,  Hyana contributed a function
 *
 * This script is responsible for tab related workings.
 * It generates, coordinates, and works with tab links, tab content divs, and their associated pathway data.
 *    Brings back tabs after refresh (beginning of the document)
 *    Creates new tabs, restores old ones, changed which tab is selected and opens/closes tabs,
 *      updating the data at
 *      provides a method to access all tabs
 *
 * Every tab has a tab link, a tab conent div, and a string version of the pathway data in sessionStorage.
 *
 * Some global variables that help to coordinate them are:
 *    currentTab: a string holding the currently selected tab's numerical id
 *    currentPathway: a javascript object holding the current tab's pathway data in a way the is easy to manipulate
 *    serverSaveNeeded: a boolean indicating whether the current tab's pathway data has changes which should be saved on the server
 *
 *    Session Storage keys:
 *      tabsCreated: a string containing a number that is incremented everytime a tab is created, and it used to generate new tab id's.
 *         This is only reset on logout.
 *      #: Every tab that is shown has a corresponding key in sessionStorage that contains it's associated pathway data.
 *
 *
 *  The major methods use and share many helper methods.
 *
 *
 *  Hyana contributed a function that asks the user whether to save a tab they are closing in a visually appealing way.
 */

//file paths:
var tabpath = "php/tab.html.php";

// current tab element's id
var currentTab;
/* current pathway data as a javascript object, 
used to facilitate storage of user changes from dragging
*/
var currentPathway;

// flag indicating when there are changes stored on the client for the current tab that could be saved on the server
var serverSaveNeeded = false;

// sessionStorage stores enough information on each pathway to bring it back after a refresh.
// Each pathway is referenced by a numerical id that matches that of the tab that stores it.
// the stored pathway also usable for keeping track of the nodes' positions while the user is interacting with the pathway.
// Just need to convert from string with JSON.parse() first, because sessionStorage can only store strings.
if (!sessionStorage["tabsCreated"]) {
  // Only set it to zero if it hasn't been set yet.
  sessionStorage["tabsCreated"] = "0"; // sessionStorage always stored data as text, even if given an int
} else {
  // ______________________________________________________________________ <-- This should run when it refreshes
  //                 If there are pathway tabs, put them up!
  forEveryTab(function (tabID) {
    // The pathway keys are the same as the id's of the tabs that hold them
    var pathway = JSON.parse(sessionStorage[tabID]);
    // NEED TO ADD: Also use pathway to visually put up the course map that the user has made.
    restoreTab(pathway.title, tabID);
  });
} // _____________________________________________________________________________

// Loops through all the tabs,
// Takes a function and passes each tabID (a numerical string) to it
function forEveryTab(tabFunction) {
  // In sessionStorage, each pathway is referenced by a numerical id that matches that of the tab that stores it.
  // the stored pathway needs to be converted from string with JSON.parse() first, because sessionStorage can only store strings.
  for (var key in sessionStorage) {
    if (parseInt(key).toString() != "NaN") {
      // If it is a number, it must be a key for pathway
      tabFunction(key);
    }
  }
}

function openTab(evt, tabID) {
  unselectTabs(); // Reverts the appearence of the current tab, and hides it's content.
  // Show the current tab, and add an "active" class to the button that opened the tab
  selectTab(evt.currentTarget, document.getElementById(tabID), tabID);
  // Set up variables for use in pathway.js
  getCurrentElements();
}

function newTab() {
  // if(sessionStorage["tabsCreated"] == 5) {
  //   alert("You have reached the maximum number of pathway tabs (5).")
  //   return
  // }

  unselectTabs(); // Hides the other tab content
  var tabID = newTabID();
  var title = "Untitled_" + tabID; // Intitial title for the pathway
  // Adds the tab's icon to the navigation bar
  var tabLink = createTabLink(tabID, title);
  // Creates a new tabcontent div containing the interactive pathway orgainzer
  var tabcontent = createPathwayDiv(tabID);

  // Add new pathway to sessionStorage
  var pathway = { title: title };
  for (var i = 1; i <= 8; i++) {
    pathway["sem_" + i] = { locked: false, nodes: {} };
  }
  pathway["sem_-1"] = { locked: false, nodes: {} };
  // The pathway save status should be initialized to true because a new pathway doesn't exist on the server.
  pathway["serverSaveNeeded"] = true;
  sessionStorage[tabID] = JSON.stringify(pathway);

  // Activates the tablink and displays the tab content
  // Also parses the JSON pathway into currentPathway, and stores the original currentPathway if it was already defined
  selectTab(tabLink, tabcontent, tabID);
}

//    -----------------      HELPER FUNCTIONS:      -------------------

// Updates sessionStorage["tabsCreated"], and uses that to generate the new tab ID
function newTabID() {
  // Update "tabsCreated"
  // sessionStorage always stored data as text, even if given an int
  sessionStorage["tabsCreated"] = parseInt(sessionStorage["tabsCreated"]) + 1;
  // Use "tabsCreated" for tabID
  return sessionStorage["tabsCreated"];
}

// Takes two strings
// One is the tabID (a number)
function restoreTab(pathwayTitle, tabID) {
  // Adds a tab's icon to the navigation bar
  createTabLink(tabID, pathwayTitle);
  // Creates the tabcontent div containing the interactive pathway orgainzer
  createPathwayDiv(tabID, pathwayTitle);
}

// Hides the content of all the tabs to hide the one that is currently showing, and removes the class active from all the tabs for styling purposes.
function unselectTabs() {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
}

// Takes a reference to the tablink and tabcontent,
// Activates the tablink and displays the tab content and sets currentTab
// Also parses the JSON pathway into currentPathway, and stores the original currentPathway if it was already defined
function selectTab(tabLink, tabcontent, tabID) {
  tabLink.className += " active";
  if (tabcontent != null) {
    tabcontent.style.display = "block";
  }
  // If currentPathway was already set, save it in sessionStorage[currentTab]
  storeCurrentPathway();

  // Now update the current tab id then pathway
  currentTab = tabID;
  currentPathway = JSON.parse(sessionStorage[currentTab]);

  // Update the global serverSaveNeeded flag to reflect the status of the new currentPathway
  serverSaveNeeded = currentPathway["serverSaveNeeded"];

  restorePathway();
}

// Creates a new tablink in the navigation bar
// The tabID parameter is a unique id for every tab,
//        using sessionStorage["tabsCreated"].
//        It is a parameter so that this function can be explicitly correlated with createPathwayDiv()
// Returns a reference to the new tablink, a button element
function createTabLink(tabID, title) {
  var tabLink = document.createElement("button");
  tabLink.className = "tablinks";
  tabLink.id = "link_" + tabID;
  tabLink.onclick = function () {
    openTab(event, tabID);
  };
  var tabTitle = document.createElement("span");
  tabTitle.innerHTML = title;
  tabTitle.id = "title_" + tabID;
  tabLink.appendChild(tabTitle);

  var tabX = document.createElement("span");
  tabX.innerHTML = "&times";
  tabX.onclick = function () {
    removeTab(tabID);
  };
  tabLink.appendChild(tabX);

  var tabBar = document.getElementById("tab");
  var plusTabIndex = tabBar.children.length - 3; // The Admin, Login, and + come last
  tabBar.insertBefore(tabLink, tabBar.children[plusTabIndex]); // Insert the new tab before the plus tab.
  return tabLink;
}

function removeTab(tabID) {
  /* 
  Does not update sessionStorage["tabsCreated"] because that is used to generate new tab id's.
  There is no reason to expect that the removed tab will be the one with the highest id number, so 
  updating sessionStorage["tabsCreated"] would just make things more complicated than needed.
  */

  // Remove the tablink:
  var tabBar = document.getElementById("tab");
  var tabLink = document.getElementById("link_" + tabID);
  tabBar.removeChild(tabLink);

  // Remove the tab content
  var tabContent = document.getElementById(tabID);
  tabContent.parentNode.removeChild(tabContent);

  /*@author Hyana */
  $(function () {
    $("#dialog-confirm").dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        "Save the tab": function () {
          /* @author Allison */
          if (tabID == currentTab) {
            // currentPathway corresponds to currentTab
            // currentPathway might hold something new
            // If currentPathway was already set, save it in sessionStorage[currentTab]
            storeCurrentPathway();
          }
          save(tabID);
          removeClientData(tabID); // Remove the tab from data on the client.
          /* End of Allison's code in Hyana's contribution */
          $(this).dialog("close");
        },
        "Don't save the tab": function () {
          removeClientData(tabID); // Remove the tab from data on the client.
          $(this).dialog("close");
        },
      },
    });
  });
  /* End of Hyana's contribution in Allison's code */
}

// Stores currentPathway in sessionStorage
// uses the global variable currentTab
// Returns true if currentPathway was defined and therefore saved, false if not.
function storeCurrentPathway() {
  if (typeof currentPathway !== "undefined") {
    // If currentPathway was already set, save it in sessionStorage
    sessionStorage[currentTab] = JSON.stringify(currentPathway);
    return true;
  }
  return false;
}

/**
 * Removes the tab from the storage on the client
 * @param {string} tabID
 */
function removeClientData(tabID) {
  // Remove stored pathway from session storage
  sessionStorage.removeItem(tabID);
  // Clear current pathway
  currentPathway = undefined;
}

// Creates a new tabcontent div containing the interactive pathway orgainzer
// The tabID parameter is a unique id for every tab,
//        using sessionStorage["tabsCreated"].
//        It is a parameter so that this function can be explicitly correlated with createTabLink()
// Returns a reference to the new tabcontent, a div element
function createPathwayDiv(tabID, title) {
  var pathwayOrganizer = document.createElement("div");
  pathwayOrganizer.id = tabID; // unique ID for every tab
  pathwayOrganizer.className = "tabcontent";
  // innerHTML:
  // Gets the content of tab.php from the server to load it into the innerHTML of the new tab div
  // Is there a better way? Is it better to read the tab.php file with a FileReader and put that text into the div?
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // put the pathway organizer HTML into the new tabcontent
      pathwayOrganizer.innerHTML = xhttp.responseText;

      /* If the parameter title was given, this tab has a name,
      and the tab content should be adjusted to reflect that */
      if (typeof title === "string") {
        // Checking that the type is a string is mostly about checking that it is not undefined.
        var titleElement = pathwayOrganizer.getElementsByClassName(
          "pathwayTitle"
        )[0]; // There will only be titleElement in a tab, so the first one is it.
        titleElement.innerText = titleElement.innerText.replace(
          "Untitled Pathway",
          title
        );
      }
    }
  };
  xhttp.open("GET", tabpath, true);
  xhttp.send();

  document.getElementById("content").appendChild(pathwayOrganizer);
  return pathwayOrganizer;
}

var modal_register = document.getElementById("register");
var modal_login = document.getElementById("login");

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
  if (event.target == modal_login) {
    modal_login.style.display = "none";
  }
  if (event.target == modal_register) {
    modal_register.style.display = "none";
  }
};
