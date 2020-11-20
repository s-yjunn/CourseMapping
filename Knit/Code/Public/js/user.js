// This function "opens" a user profile in the "to" div and hides the "from" div
function openProfile(username, to, from) {
    //console.log(username + "'s profile opened from " + from);
    // load the profile into the to div, then
    $("#"+to).load("php/profileStatic.php?uname=" + username + "&to=" + to + "&from=" + from, function(){
        // hide the from div
        hide(from);
        // show the profile
        show(to);
    });
}