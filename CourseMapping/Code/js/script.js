//file paths:
var tabpath = "php/tab.html.php";

// current tab element's id
var currentTab;

// sessionStorage stores enough information on each pathway to bring it back after a refresh.
// Each pathway is referenced by a numerical id that matches that of the tab that stores it.
// the stored pathway also usable for keeping track of the nodes' positions while the user is interacting with the pathway.
// Just need to convert from string with JSON.parse() first, because sessionStorage can only store strings.
if(!sessionStorage["tabsCreated"]) { // Only set it to zero if it hasn't been set yet.
  sessionStorage["tabsCreated"] = "0"; // sessionStorage always stored data as text, even if given an int
} else {  // ______________________________________________________________________ <-- This should run when it refreshes
  for(var key in sessionStorage) { //                 If there are pathway tabs, put them up!
    if(parseInt(key).toString() != "NaN") {// If it is a number, it must be a key for pathway
      // The pathway keys are the same as the id's of the tabs that hold them
      var pathway = JSON.parse(sessionStorage[key]);
      restoreTab(pathway.title, key);
    }
  }
} // _____________________________________________________________________________

function openTab(evt, tabID) {
  unselectTabs(); // Reverts the appearence of the current tab, and hides it's content.
  // Show the current tab, and add an "active" class to the button that opened the tab
  selectTab(evt.currentTarget, document.getElementById(tabID));
  currentTab = tabID; // Update the current tab id
}

function newTab() {
  // if(sessionStorage["tabsCreated"] == 5) { 
  //   alert("You have reached the maximum number of pathway tabs (5).")
  //   return
  // }

  // sessionStorage always stored data as text, even if given an int
  sessionStorage["tabsCreated"] = parseInt(sessionStorage["tabsCreated"]) + 1; 
  unselectTabs(); // Hides the other tab content
  var tabID = sessionStorage["tabsCreated"];
  var title = "Untitled_" + tabID; // Intitial title for the pathway
  // Adds the tab's icon to the navigation bar
  var tabLink = createTabLink(tabID, title);
  // Creates a new tabcontent div containing the interactive pathway orgainzer
  var tabcontent = createPathwayDiv(tabID);
  // Activates the tablink and displays the tab content
  selectTab(tabLink, tabcontent);

  // Add new pathway to sessionStorage
  var pathway = {title: title};
  for(var i = 1; i <= 8; i++) {
    pathway["sem_" + i] = { locked:true, nodes:{} };
  }
  sessionStorage[tabID] = JSON.stringify(pathway);
 
  currentTab = tabID; // Update the current tab id
  // // Update the max-width based on the number of tab
  // updsateCSS()
}

//    -----------------      HELPER FUNCTIONS:      -------------------

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
// Activates the tablink and displays the tab content
function selectTab(tabLink, tabcontent) {
  tabLink.className += " active";
  tabcontent.style.display = "block";
}

// Creates a new tablink in the navigation bar
// The tabID parameter is a unique id for every tab, 
//        using sessionStorage["tabsCreated"]. 
//        It is a parameter so that this function can be explicitly correlated with createPathwayDiv()
// Returns a reference to the new tablink, a button element
function createTabLink(tabID, title) {
  var tabLink = document.createElement("button");
  tabLink.className = "tablinks";
  tabLink.onclick = function(){openTab(event, tabID)};
  tabLink.innerHTML = title;
  var tabBar = document.getElementById("tab");
  var plusTabIndex = tabBar.children.length - 3; // The Admin, Login, and + come last
  tabBar.insertBefore(tabLink, tabBar.children[plusTabIndex]); // Insert the new tab before the plus tab.
  return tabLink;
}

// Creates a new tabcontent div containing the interactive pathway orgainzer
// The tabID parameter is a unique id for every tab,
//        using sessionStorage["tabsCreated"]. 
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
