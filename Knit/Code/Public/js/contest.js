function updateVote(i, vote){
    alert(i);
    alert(vote);

    document.getElementById("numVotes").innerHTML = vote + 1;

    // contestantData[i]= vote + 1;

    $("#hide").click(function(){
        $("#hide").hide();
    });

    document.getElementById("demo").innerHTML = "Thanks for voting!";

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