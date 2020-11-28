//file paths:
var tabpath = "php/tab.html.php";

// current tab element's id
var currentTab;
// sessionStorage stores enough information on each pathway to bring it back after a refresh.
// Each pathway is referenced by a numerical id that matches that of the tab that stores it.
// the stored pathway also usable for keeping track of the nodes' positions while the user is interacting with the pathway.
// Just need to convert from string with JSON.parse() first, because sessionStorage can only store strings.
if(!sessionStorage["tabsOpen"]) { // Only set it to zero if it hasn't been set yet.
  sessionStorage["tabsOpen"] = "0"; // sessionStorage always stored data as text, even if given an int
} else {  // ______________________________________________________________________ <-- This should run when it refreshes
  //                 If there are pathway tabs, put them up!
  forEveryTab(function(tabID) {
    // The pathway keys are the same as the id's of the tabs that hold them
    var pathway = JSON.parse(sessionStorage[tabID]);
    restoreTab(pathway.title, tabID);
  });
} // _____________________________________________________________________________

// Loops through all the tabs, 
// Takes a function and passes each tabID (a string) to it  
function forEveryTab(tabFunction) {
  // In sessionStorage, each pathway is referenced by a numerical id that matches that of the tab that stores it.
  // the stored pathway needs to be converted from string with JSON.parse() first, because sessionStorage can only store strings.
  for(var key in sessionStorage) { 
    if(parseInt(key).toString() != "NaN") {// If it is a number, it must be a key for pathway
      tabFunction(key);
    }
  }
}

function openTab(evt, tabID) {
  unselectTabs(); // Reverts the appearence of the current tab, and hides it's content.
  // Show the current tab, and add an "active" class to the button that opened the tab
  selectTab(evt.currentTarget, document.getElementById(tabID), tabID);
}

function newTab() {
  // if(sessionStorage["tabsOpen"] == 5) { 
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
  // Activates the tablink and displays the tab content
  selectTab(tabLink, tabcontent, tabID);

  // Add new pathway to sessionStorage
  var pathway = {title: title};
  for(var i = 1; i <= 8; i++) {
    pathway["sem_" + i] = { locked:true, nodes:{} };
  }
  sessionStorage[tabID] = JSON.stringify(pathway);
}

//    -----------------      HELPER FUNCTIONS:      -------------------

// Updates sessionStorage["tabsOpen"], and uses that to generate the new tab ID
function newTabID() {
  // Update "tabsOpen"
  // sessionStorage always stored data as text, even if given an int
  sessionStorage["tabsOpen"] = parseInt(sessionStorage["tabsOpen"]) + 1; 
  // Use "tabsOpen" for tabID
  return sessionStorage["tabsOpen"];
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
// Also parses the JSON pathway for this tab to work with, and stores one if it was alread open
function selectTab(tabLink, tabcontent, tabID) {
  tabLink.className += " active";
  tabcontent.style.display = "block";

  if(currentPathway) { // If currentPathway was already set, save it in sessionStorage
    sessionStorage[currentTab] = JSON.stringify(currentPathway);
  }

  currentTab = tabID; // Now update the current tab id

  currentPathway = JSON.parse(sessionStorage[currentTab]);
}

// Creates a new tablink in the navigation bar
// The tabID parameter is a unique id for every tab, 
//        using sessionStorage["tabsOpen"]. 
//        It is a parameter so that this function can be explicitly correlated with createPathwayDiv()
// Returns a reference to the new tablink, a button element
function createTabLink(tabID, title) {
  var tabLink = document.createElement("button");
  tabLink.className = "tablinks";
  tabLink.id = "link_" + tabID;
  tabLink.onclick = function(){openTab(event, tabID)};
  tabLink.innerHTML = title;
  var tabBar = document.getElementById("tab");
  var plusTabIndex = tabBar.children.length - 3; // The Admin, Login, and + come last
  tabBar.insertBefore(tabLink, tabBar.children[plusTabIndex]); // Insert the new tab before the plus tab.
  return tabLink;
}

// Creates a new tabcontent div containing the interactive pathway orgainzer
// The tabID parameter is a unique id for every tab,
//        using sessionStorage["tabsOpen"]. 
//        It is a parameter so that this function can be explicitly correlated with createTabLink()
// Returns a reference to the new tabcontent, a div element
function createPathwayDiv(tabID) {
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
    }
  };
  xhttp.open("GET", tabpath, true);
  xhttp.send();

  document.getElementById("content").appendChild(pathwayOrganizer);
  return pathwayOrganizer;
}

var modal_register = document.getElementById('register');
var modal_login = document.getElementById('login');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
if (event.target == modal_login) {
  modal_login.style.display = "none";
} if (event.target == modal_register){
  modal_register.style.display = "none";
}
}