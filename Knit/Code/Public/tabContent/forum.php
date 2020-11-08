<?php
  //Establish which div to show when visitor clicks the "write a post" button
  if (isset($_SESSION['username'])){
    $showCompose = "\"show('composePost')\"";
  } else {
    $showCompose = "\"show('loginPlease')\"";
  }

?>
<div id="Forum" class="tabcontent">
	<div class="card">
    <h3>Forum</h3>
    <!--This div is what the user sees when they first open the forum-->
    <div id="forumHome">
      <!--reload button. Forum is also reloaded anytime the user adds a post or changes the sorting method-->
      <button type="button" onclick="refreshForumIndex()">Refresh</button>
      <!--Button to write a post. Opens a composition div if the user is logged in, otherwise one that tells them to login.-->
      <button type="button" onclick=<?=$showCompose; ?>>Write a post</button>
      
      <!--This is the form to compose a post-->
      <div class="dark" id="composePost">
        <div class="float">
          <h4>Compose post</h4>
          <input type="text" id="postTitle" placeholder="Your post's title"><br>
          <textarea id = "postContent" placeholder="Your post's content"></textarea><br>
          <button type="button" onclick="postPost()">Post</button>           
          <button id="cancel" onclick="hide('composePost')">Cancel</button>
          <span id = "postStatus"></span> <!-- for validation of a post-->
        </div>
      </div>

      <!--This is the forum "index": a table of links to existing forum posts-->
      <div id = "forumIndex">
        <h4>All posts</h4>
        <!--Selector for how to sort posts-->
        <form>
          <label for="indexView">Sort by:</label>
          <select id="indexView" onchange="sortForumIndex(this.value)">>
            <option value="time">Newest first</option>
            <option value="score">Highest ranked first</option>
            <option value="responses">Unanswered first</option>
          </select>
        </form>

        <!--table of post stats and links to open them-->
        <div id = "postList">
          <?php include "php/forum/postList.php";?>
        </div>
      </div>
    </div>      

    <!--This div is filled by "php/forum/post.php" whenever a post is called on-->
    <div id = "forumPost"></div>

    <!--this div shows up when visitors try to post, respond, or vote without being logged in-->
    <div class="dark" id="loginPlease">
      <div class="float">
        <p>Only registered users can post and vote in the forum. Sign up or log in to access these features!</p>
        <button id="exit" onclick="hide('loginPlease')">Got it</button>
      </div>
    </div>
	</div>
</div>

<script src="js/forum.js"></script>