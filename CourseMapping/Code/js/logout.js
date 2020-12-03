/**
 * @author Allison Brand, Hyana
 * 
 * Allison made the overall function, Hyana made the part that asks the user for input.
 */

// Uses a function from script.js

function clearUser() {
    // sessionStorage stores enough information on each pathway to bring it back after a refresh.
    // Each pathway is referenced by a numerical id that matches that of the tab that stores it.
    // Just need to convert from string with JSON.parse() first, because sessionStorage can only store strings.

    // Check if there are tabs open:
    if(typeof sessionStorage["tabsCreated"] !== 'undefined' && sessionStorage["tabsCreated"] != "0") { 
        // If so, ask the user if they want to save pathways.
        var saveWanted = 
        window.confirm("You want to save all open tabs? If you click cancel, all works you've done will be permanently deleted."); // This line is Hyana's.
        if(saveWanted) {
            // In sessionStorage, each pathway is referenced by a numerical id that matches that of the tab that stores it.
            forEveryTab(save);
        }
    }
    sessionStorage.clear(); 
}