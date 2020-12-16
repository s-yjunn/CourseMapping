function updateVote(i){
    $(document).ready(
        $.ajax({
        type: "POST",
        url: "php/updateVote.php",
        data: {index:i},
        success: function(result) {
            $('.contestVote').each(function() {
                $(this).hide();
            });			
        }
    })
    );   
  }

// This function "opens" a pattern by index in the *to* div and hides the *from* div
// *fromLink* is the id of the div whose level we want to return to when the pattern closes
// @author Isabel
function openPattern(patternIndex, to, from, fromLink) {
    // Load the content into the pattern div, then
    $("#"+to).load("php/pattern.php?index=" + patternIndex + "&to=" + to + "&from=" + from + "&fromLink=" + fromLink, function(){
        if (from === "adminContest2") {
            // hide the menu
            hide("adminContest"); // last minute fix for showing contestants
        } else {
            hide(from);
        }
        // show the pattern
        show(to);
        // go to the top of the pattern
        window.location.href = "#"+to;
    });
}