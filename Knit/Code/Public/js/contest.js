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

// This function "opens" a pattern in either the "featured" or "contest" tab
function openPattern(patternIndex, from) {
    console.log("Pattern " + patternIndex + " opened from " + from);
    //Loads the content into the pattern div, then
    $("#pattern").load("php/pattern.php?index=" + patternIndex + "&from=" + from, function(){
        //Show the pattern
        show('pattern');
        // hide the menu
        hide(from);
    });
}