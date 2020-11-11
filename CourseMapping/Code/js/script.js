//file paths:
var tabpath = "php/tab.html.php";

sessionStorage["tabsCreated"] = "0"; // sessionStorage always stored data as text, even if given an int

function openTab(evt, tabName) {
  unselectTabs(); // Reverts the appearence of the current tab, and hides it's content.

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}

function newTab() {
  // sessionStorage always stored data as text, even if given an int
  sessionStorage["tabsCreated"] = parseInt(sessionStorage["tabsCreated"]) + 1; 

  unselectTabs(); // Hides the other tab content

  // Adds the tab's icon to the navigation bar
  newTabLink(sessionStorage["tabsCreated"]);
  // Creates a new tabcontent div containing the interactive pathway orgainzer
  newPathway(sessionStorage["tabsCreated"]);
}


//    -----------------      HELPER FUNCTIONS:      -------------------

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

// Creates a new tablink in the navigation bar
//  the tabID parameter is a unique id for every tab, using sessionStorage["tabsCreated"]. It is a parameter so that this function can be explicitly correlated with newPathway()
function newTabLink(tabID) {
  var tabLink = document.createElement("button");
  tabLink.className = "tablinks active";
  tabLink.onclick = function(){openTab(event, tabID)};
  tabLink.innerHTML = "Untitled_" + tabID;
  var tabBar = document.getElementById("tab");
  var plusTabIndex = tabBar.children.length - 2; // The Login and + come last
  tabBar.insertBefore(tabLink, tabBar.children[plusTabIndex]); // Insert the new tab before the plus tab.
}

// Creates a new tabcontent div containing the interactive pathway orgainzer
//  the tabID parameter is a unique id for every tab, using sessionStorage["tabsCreated"]. It is a parameter so that this function can be explicitly correlated with newTabLink()
function newPathway(tabID) {
  var pathwayOrganizer = document.createElement("div");
  pathwayOrganizer.id = tabID; // unique ID for every tab
  pathwayOrganizer.className = "tabcontent";
  // innerHTML:
  // Gets the content of tab.php from the server to load it into the innerHTML of the new tab div
  // Is there a better way? Is it better to read the tab.php file with a FileReader and put that text into the div?
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         // Typical action to be performed when the document is ready:
         pathwayOrganizer.innerHTML = xhttp.responseText;
      }
  };
  xhttp.open("POST", tabpath, true);
  xhttp.send(); 

  document.getElementById("content").appendChild(pathwayOrganizer);
  pathwayOrganizer.style.display = "block";
}
