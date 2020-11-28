// Uses a function from script.js

function clearUser() {
    // sessionStorage stores enough information on each pathway to bring it back after a refresh.
    // Each pathway is referenced by a numerical id that matches that of the tab that stores it.
    // Just need to convert from string with JSON.parse() first, because sessionStorage can only store strings.

    // Check if there are tabs open:
    if(sessionStorage["tabsOpen"] && sessionStorage["tabsOpen"] != "0") { // If so, ask the user if they want to save pathways.
        var saveWanted = window.confirm("Do you want to save all open tabs?");
        if(saveWanted) {
            // In sessionStorage, each pathway is referenced by a numerical id that matches that of the tab that stores it.
            forEveryTab(save);
        }
    }
    sessionStorage.clear(); 
}