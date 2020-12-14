/* This file contains all js functions related directly to the forum (user profile generation in user.js)
* @author Isabel
* 
*/

//This function opens the specified post
function openPost(postIndex, from) {
    //Loads the content into the post div, then
    $("#forumPost").load("php/forum/post.php?index=" + postIndex + "&from=" + from, function(){
        //Show the post
        hide(from);
        show('forumPost');
    });
}


//This function (horrible name, I'm sorry) handles the client-side of adding a new post to the forum
function postPost(username) {
    //Get post elements
    var postTitle = document.getElementById("postTitle").value.trim();
    var postContent = document.getElementById("postContent").value.trim();
    if (postTitle == "") { // make sure they've entered a title
        document.getElementById("postStatus").innerHTML = "<p class='alert alert-danger' role='alert'>Please enter a post title.</p>";
    } else if (postContent == "") { // make sure they've written a post
        document.getElementById("postStatus").innerHTML = "<p class='alert alert-danger' role='alert'>Please enter some post content.</p>";
    // If all is well, send the post to the php processing page
    } else {
        //Get the post ready for html outputting (replace newlines with <br>)
        postContent = postContent.replace(/(?:\r\n|\r|\n)/g, '<br>');
        //Process it and output the response, then
        var posting = $.post("php/forum/addPost.php", {postTitle: postTitle, postContent: postContent, uname: username});
        // When done, 
        posting.done(
            function() {
                //Update the forum index
                refreshForumIndex();
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

// This function handles the client-side of deleting a post
// postIndex: the index of the post in question
function deletePost(postIndex) {
    // send the request to the php script
    $.ajax({
        type: "POST",
        url: "php/forum/deletePost.php",
        data:{index: postIndex},
        // when returned (no error catching yet)
        success: function() {
            // reload the forum menu
            refreshForumIndex();
            // send a success message
            $("#forumDiv").html("<p class='alert alert-info' role='alert'>Your post was deleted.</p>");
            // hide the interaction div
            hide('deletePost');
            // return to the forum menu
            hide('forumPost');
            show('forumHome');
        }
    });
}

//This function handles the client-side of adding a new response to a forum post
//postIndex: the index of the parent post
function postResponse(loggedIn, postIndex) {
    if (loggedIn == "true") {
        //Get response elements
        var responseContent = document.getElementById("responseContent").value.trim();
        if (responseContent == "") { // make sure they've actually written something
            document.getElementById("responseStatus").innerHTML = "<p class='alert alert-danger' role='alert'>Please enter a response.</p>";
        // If all is well, send it to the php processing page
        } else {
            responseContent = responseContent.replace(/(?:\r\n|\r|\n)/g, '<br>'); // replace newlines with <br>
            var posting = $.post( "php/forum/addResponse.php", { parent: postIndex, responseContent: responseContent } );

            //When done,
            posting.done(
                function(){
                    //Update the response list
                    refreshResponses(postIndex);

                    //Update main page stats
                    refreshForumIndex();
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

// This function sets up the 'deleteResponse' div to delete the proper response
function showDeleteResponse(postIndex, responseIndex) {
    $("#deleteRspBtn").attr("onclick","deleteResponse(" + postIndex + ", " + responseIndex + ")");
    show("deleteResponse");
}

// This function handles the client side of deleting a response to a post
function deleteResponse(postIndex, responseIndex) {
    // Send the request to the php script
    $.ajax({
        type: "POST",
        url: "php/forum/deleteResponse.php",
        data:{postIndex: postIndex, responseIndex: responseIndex},
        // when returned (no error catching yet)
        success: function() {
            // update the list of responses
            refreshResponses(postIndex);
            // update forum index (since this tracks # of responses)
            refreshForumIndex();
            // hide the interaction div
            hide('deleteResponse');
        }
    });
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
                refreshForumIndex();
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
                refreshResponses(postIndex);
            }
        )
    } else {
        show('loginPlease');
    }
}

//This function retrieves the forum menu, resorted as per the parameter selected, and loads it.
function sortForumIndex(param) { 
    $("#postList").load("php/forum/postList.php?sortBy=" + param);
    // clear any alerts
    $("#forumDiv").html("");
}

//Similar to the above, but has to search for a parameter
function refreshForumIndex(){
    sortIndexBy = document.getElementById('indexView').value;
    sortForumIndex(sortIndexBy);
}

//Sorts a post's responses by a parameter
function sortPostResponses(postIndex, param) {
    $("#responseList").load("php/forum/responseList.php?index="+postIndex+"&sortBy=" + param);
}

//Similar to the above, but has to search for a parameter
function refreshResponses(postIndex){
    sortResponsesBy = document.getElementById('responsesView').value;
    sortPostResponses(postIndex, sortResponsesBy);
}

// This function handles the client-side of searching the forum
function searchForum() {
    var query = $("#forumSearchQ").val().trim();

    var sortBy = $('#searchView').val();
    if (query == "") { // make sure they've actually entered something
        $("#forumDiv").html("<p class='alert alert-danger' role='alert'>Please enter a search query.</p>");
    } else {
        $("#forumDiv").empty();
        $("#fSearchTitle").html("Results for \"" + query + "\"");
        $.ajax({
            type: "POST",
            url: "php/forum/searchList.php",
            data: {param: query, sortBy: sortBy},
            // when returned (no error catching yet)
            success: function(response) {
                $("#searchList").html(response);
                hide("forumHome");
                show("forumSearch");
            }
        });
    }
}

// this function handles the client side of re-sorting search responses 
// (+ refreshing search results)
function sortForumSearch(sortBy) {
    var query = $("#forumSearchQ").val().trim();
    $.ajax({
        type: "POST",
        url: "php/forum/searchList.php",
        data: {param: query, sortBy: sortBy},
        // when returned (no error catching yet)
        success: function(response) {
            $("#searchList").html(response);
        }
    });
}