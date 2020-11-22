function clearUser() {
    // sessionStorage stores enough information on each pathway to bring it back after a refresh.
    // Each pathway is referenced by a numerical id that matches that of the tab that stores it.
    // Just need to convert from string with JSON.parse() first, because sessionStorage can only store strings.

    // Check if there are tabs open:
    if(sessionStorage["tabsOpen"] && sessionStorage["tabsOpen"] != "0") { // If so, ask the user if they want to save pathways.
        // NEED TO ADD: Ask user whether they want to save
        var saveWanted = true;
        if(saveWanted) {
            for(var key in sessionStorage) {
                if(parseInt(key).toString() != "NaN") {// If it is a number, it must be a key for pathway
                    save(key);
                }
            }
        }
    }
    sessionStorage.clear(); 
}