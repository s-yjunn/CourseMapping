//This function (horrible name, I'm sorry) handles the client-side of adding a new post to the forum
function postPost() {
    //console.log("Post was posted!");
    //Get post elements
    var postTitle = document.getElementById("postTitle").value.trim();
    var postContent = document.getElementById("postContent").value.trim();
    if (postTitle == "") { // make sure they've entered a title
        document.getElementById("postStatus").innerHTML = "<p>Please enter a post title.</p>";
    } else if (postContent == "") { // make sure they've written a post
        document.getElementById("postStatus").innerHTML = "<p>Please enter some post content.</p>"
    // If all is well, send it to the php processing page
    } else {
        postContent = postContent.replace(/(?:\r\n|\r|\n)/g, '<br>'); //replace newlines with <br>
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
                //Clear the composition area
                document.getElementById("postTitle").value = "";
                document.getElementById("postContent").value = "";
                document.getElementById("postStatus").innerHTML = "";
            }
        }
        //Send to php processing page
        xmlhttp.open("GET","php/forum/addPost.php?postTitle="+postTitle+"&postContent="+postContent, true);
        xmlhttp.send();
    }
}

//This function handles the client-side of adding a new response to a forum post
//postIndex: the index of the parent post
function postResponse(postIndex) {
    //Get response elements
    var responseContent = document.getElementById("responseContent" + postIndex).value.trim();
    if (responseContent == "") { // make sure they've actuall written something
        document.getElementById("responseStatus" + postIndex).innerHTML = "<p>Please enter a response.</p>"
    // If all is well, send it to the php processing page
    } else {
        responseContent = responseContent.replace(/(?:\r\n|\r|\n)/g, '<br>'); // replace newlines with <br>
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                // Update the container post & the menu
                $("#post"+ postIndex).load(location.href+" #post" + postIndex + ">*","");
                $("#forumMenu").load(location.href+" #forumMenu>*","");
                //Clear the composition area
                document.getElementById("responseContent" + postIndex).value = "";
                document.getElementById("responseStatus" + postIndex).innerHTML = "";
            }
        }
        //Send to php processing page
        xmlhttp.open("GET","php/forum/addResponse.php?parent=" + postIndex +  "&responseContent="+responseContent, true);
        xmlhttp.send();
    }
}

//This function handles the client-side of voting on posts
function postVote(upOrDown, postIndex) {
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            // Update the container post & the menu
            $("#post"+ postIndex).load(location.href+" #post" + postIndex + ">*","");
            $("#forumMenu").load(location.href+" #forumMenu>*","");
        }
    }
    //Send to php processing page
    xmlhttp.open("GET","php/forum/addUpDownVote.php?vote=" + upOrDown + "&type=post&index=" + postIndex, true);
    xmlhttp.send();
}

//This (only slightly different function) handles the client-side of voting on responses
function responseVote(upOrDown, postIndex, responseIndex) {
    index = JSON.stringify([postIndex, responseIndex]);
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            // Update the container post
            $("#post"+ postIndex).load(location.href+" #post" + postIndex + ">*","");
        }
    }
    //Send to php processing page
    xmlhttp.open("GET","php/forum/addUpDownVote.php?vote=" + upOrDown + "&type=response&index=" + index, true);
    xmlhttp.send();
}

//This reloads the content divs of the forum menu
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