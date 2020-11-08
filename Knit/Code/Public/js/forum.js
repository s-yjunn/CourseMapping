//This function opens the specified post
function openPost(postIndex) {
    //Loads the content into the post div, then
    $("#forumPost").load("php/forum/post.php?index=" + postIndex, function(){
        //Show the post
        show('forumPost');
        hide('forumHome');
    });
}


//This function (horrible name, I'm sorry) handles the client-side of adding a new post to the forum
function postPost() {
    //Get post elements
    var postTitle = document.getElementById("postTitle").value.trim();
    var postContent = document.getElementById("postContent").value.trim();
    if (postTitle == "") { // make sure they've entered a title
        document.getElementById("postStatus").innerHTML = "<p>Please enter a post title.</p>";
    } else if (postContent == "") { // make sure they've written a post
        document.getElementById("postStatus").innerHTML = "<p>Please enter some post content.</p>"
    // If all is well, send the post to the php processing page
    } else {
        //Get the post ready for html outputting (replace newlines with <br>)
        postContent = postContent.replace(/(?:\r\n|\r|\n)/g, '<br>');
        //Process it and output the response, then
        var posting = $.post("php/forum/addPost.php", {postTitle: postTitle, postContent: postContent});
        // When done, 
        posting.done(
            function() {
                //Update the forum index
                sortIndexBy = document.getElementById('indexView').value;
                sortForumIndex(sortIndexBy);
                //Close the box
                hide('composePost');
                //Clear the composition area
                document.getElementById("postTitle").value = "";
                document.getElementById("postContent").value = "";
                document.getElementById("postStatus").innerHTML = "";
            }
        )
    }
}

//This function handles the client-side of adding a new response to a forum post
//postIndex: the index of the parent post
function postResponse(loggedIn, postIndex) {
    if (loggedIn == "true") {
        //Get response elements
        var responseContent = document.getElementById("responseContent").value.trim();
        if (responseContent == "") { // make sure they've actuall written something
            document.getElementById("responseStatus").innerHTML = "<p>Please enter a response.</p>"
        // If all is well, send it to the php processing page
        } else {
            responseContent = responseContent.replace(/(?:\r\n|\r|\n)/g, '<br>'); // replace newlines with <br>
            var posting = $.post( "php/forum/addResponse.php", { parent: postIndex, responseContent: responseContent } );

            //When done,
            posting.done(
                function(){
                    //Update the response list
                    sortResponsesBy = document.getElementById('responsesView').value;
                    sortPostResponses(postIndex, sortResponsesBy);

                    //Update main page stats
                    sortIndexBy = document.getElementById('indexView').value;
                    sortForumIndex(sortIndexBy);
                    //Clear the composition area
                    document.getElementById("responseContent").value = "";
                    document.getElementById("responseStatus").innerHTML = "";
                }
            )
        }
    } else {
        show("loginPlease");
    }
}

//This function handles the client-side of voting on posts
function postVote(loggedIn, upOrDown, postIndex) {
    if (loggedIn == "true") {
        //Post the vote to the php processing page
        var posting = $.post( "php/forum/addUpDownVote.php", { vote: upOrDown, type: "post", index: postIndex } );
        
        //When done,
        posting.done(
            function(){
                // Update the container post & the menu
                $("#forumPost").load("php/forum/post.php?index=" + postIndex);
                sortIndexBy = document.getElementById('indexView').value;
                sortForumIndex(sortIndexBy);
            }
        )
    } else {
        show('loginPlease');
    }   
}

//This (only slightly different function) handles the client-side of voting on responses
function responseVote(loggedIn, upOrDown, postIndex, responseIndex) {
    if (loggedIn == "true") {
        index = JSON.stringify([postIndex, responseIndex]);
        //Post the vote to the php processing page
        var posting = $.post( "php/forum/addUpDownVote.php", { vote: upOrDown, type: "response", index: index } );
        
        //When done,
        posting.done(
            function(){
                //Update the response list
                sortResponsesBy = document.getElementById('responsesView').value;
                sortPostResponses(postIndex, sortResponsesBy);
            }
        )
    } else {
        show('loginPlease');
    }
}

//This function retrieves the forum menu, resorted as per the parameter selected, and loads it.
function sortForumIndex(param) { 
    $("#postList").load("php/forum/postList.php?sortBy=" + param);
}

//Same as above but with list of responses in a post
function sortPostResponses(postIndex, param) {
    $("#responseList").load("php/forum/responseList.php?index="+postIndex+"&sortBy=" + param);
}