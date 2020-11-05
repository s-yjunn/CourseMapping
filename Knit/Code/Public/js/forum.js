//This function (horrible name, I'm sorry) sends the new post to a php file to be added to forum.json, and refreshes the main forum div
function postPost(username) {
    hide('composePost');
    //console.log("Post was posted!");
    var postTitle = document.getElementById("postTitle").value;
    var postContent = document.getElementById("postContent").value;
    var postAuthor = username;
    var forumMessage = "";
    if (postTitle != "" && postContent !="") {
        var post = {title: postTitle, author: postAuthor, content: postContent, score: 0, responses: []};
        var postString = JSON.stringify(post);
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {

                $("#Forum").load(location.href+" #Forum>*","");
            }
        }
        xmlhttp.open("GET","php/addPost.php?post="+postString, true);
        xmlhttp.send();
    }
}