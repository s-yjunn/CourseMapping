// This function "opens" a user profile in the "to" div and hides the "from" div
function openProfile(username, to, from, fromLink) {
    //console.log(username + "'s profile opened from " + from);
    // load the profile into the to div, then
    $("#"+to).load("php/user/profileStatic.php?uname=" + username + "&to=" + to + "&from=" + from + "&fromLink=" + fromLink, function(){
        // hide the from div
        hide(from);
        // show the profile
        show(to);
    });
}

function editProfile() {
    console.log("This button doesn't do anything yet");
}