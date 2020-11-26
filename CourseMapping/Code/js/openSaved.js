// Opens a tab for the pathway encoded in the given JSON string
// Deletes the button that triggered it to open the button's pathway
function openSaved(event, title, pathwayJSON) {
    var tabID = newTabID();
    sessionStorage[tabID] = pathwayJSON;
    // Adds the tab's icon to the navigation bar
    createTabLink(tabID, title);
    // Creates a new tabcontent div containing the interactive pathway orgainzer
    createPathwayDiv(tabID);

    event.currentTarget.remove();
}