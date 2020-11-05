//This function (horrible name, I'm sorry) sends the new post to a php file to be added to forum.json, and refreshes the main forum div
function postPost() {
    //console.log("Post was posted!");
    //Get post elements
    var postTitle = document.getElementById("postTitle").value.trim();
    var postContent = document.getElementById("postContent").value.trim();
    if (postTitle == "") { // make sure they've entered a title
        document.getElementById("composeStatus").innerHTML = "<p>Please enter a post title.</p>";
    } else if (postContent == "") { // make sure they've written a post
        document.getElementById("composeStatus").innerHTML = "<p>Please enter some post content.</p>"
    // If all is well, send it to the php processing page
    } else {
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                //Output the response message
                document.getElementById("forumStatus").innerHTML = this.responseText;
                // Update the forum
                $("#forumMenu").load(location.href+" #forumMenu>*","");
                $("#forumPosts").load(location.href+" #forumPosts>*","");
                //Close the box
                hide('composePost');
                //Clear the composition div
                document.getElementById("postTitle").value = "";
                document.getElementById("postContent").value = "";
                document.getElementById("composeStatus").innerHTML = "";
            }
        }
        xmlhttp.open("GET","php/addPost.php?postTitle="+postTitle+"&postContent="+postContent, true);
        xmlhttp.send();
    }
}

//This just reloads the relevant divs
function updateForum() {
    $("#forumMenu").load(location.href+" #forumMenu>*","");
    $("#forumPosts").load(location.href+" #forumPosts>*","");
    document.getElementById("forumStatus").innerHTML = "<p>Up-to-date as of " + getDateTime() + ".</p>";
}

// Returns the current date and time
function getDateTime() {
    var now = new Date(); 
    var datetime = now.toLocaleDateString()  
        + " at " 
        + now.toLocaleTimeString();;
    return datetime;
}