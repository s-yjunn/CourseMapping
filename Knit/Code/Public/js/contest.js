function updateVote(i){
    $(document).ready(
        $.ajax({
        type: "POST",
        url: "php/updateVote.php",
        data: {index:i},
        success: function(result) {
            console.log(result);
            			
        }
    })
    );   
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