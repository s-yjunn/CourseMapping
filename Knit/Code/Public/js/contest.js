function updateVote(i){
    const fs = require('fs')

    var compData = JSON.parse("../data/fake.json");
  
    var currentData = compData.contestants;
  
    currentData[i].votes += 1;

    const jsonString = JSON.stringify(compData)

    fs.writeFile("../data/fake.json", jsonString);
  
  }

// This function "opens" a pattern in the "to" div and hides the "from" div. "fromLink" is the subDiv we want to return to when the pattern closes
function openPattern(patternIndex, to, from, fromLink) {
    //console.log("Pattern " + patternIndex + " opened from " + from);
    //Loads the content into the pattern div, then
    $("#"+to).load("php/pattern.php?index=" + patternIndex + "&to=" + to + "&from=" + from + "&fromLink=" + fromLink, function(){
        // hide the menu
        hide(from);
        //Show the pattern
        show(to);
    });
}