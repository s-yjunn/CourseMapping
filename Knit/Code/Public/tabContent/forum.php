<?php
  // This is the contents of the forum tab (minus included code)
  // @author Isabel
  // Last modified 12/7/2020

  //Establish which div to show when visitor clicks the "write a post" button
  if ($loggedIn){
    $showCompose = "\"show('composePost')\"";
  } else {
    $showCompose = "\"show('loginPlease')\"";
  }
  include "php/forum/timeAgo.php";
?>

<div id="Forum" class="tabcontent">
  <h3 class="underline">Forum</h3>
  <!--This div is what the user sees when they first open the forum-->
  <div id="forumHome">
    <!--reload button. Forum is also reloaded anytime the user adds a post or changes the sorting method-->
    <button class="btn1" type="button" onclick="refreshForumIndex()"><i class="fas fa-redo-alt"></i> Refresh</button>
    <!--Button to write a post. Opens a composition div if the user is logged in, otherwise one that tells them to login.-->
    <button class="btn1" type="button" onclick=<?=$showCompose; ?>><i class="fas fa-user-edit"></i> Write a post</button>
    <!-- Any status updates go here -->
    <span id = "forumDiv"></span>

    <!--This is the form to compose a post-->
    <?php if ($loggedIn): ?>
      <div class="dark hide" id="composePost">
        <div class="float">
          <h4>Compose post</h4>
          <input type="text" id="postTitle" placeholder="Your post's title"><br>
          <textarea id = "postContent" placeholder="Your post's content"></textarea><br>
          <button class="btn1" type="button" onclick="postPost('<?= $username; ?>')">Post</button>           
          <button class="btn1" id="cancel" onclick="hide('composePost')">Cancel</button>
          <span id = "postStatus"></span> <!-- for validation of a post-->
        </div>
      </div>
    <?php endif; ?>

    <!--This is the forum "index": a table of links to existing forum posts-->
    <div id="forumIndex" class="refresh tableDiv">
      <h4>All Posts</h4>
      <!--Selector for how to sort posts-->
      <form>
        <label for="indexView">Sort by:</label>
        <select id="indexView" onchange="sortForumIndex(this.value)">>
          <option value="active">Active</option>
          <option value="score">Highest ranked</option>
          <option value="responses">Unanswered</option>
        </select>
      </form>

      <!--table of post stats and links to open them-->
      <div id="postList">
        <?php include "php/forum/postList.php";?>
      </div>
    </div>
  </div>      

  <!--This div is filled by "php/forum/post.php" whenever a post is called on-->
  <div id = "forumPost"></div>

  <!--this div shows up when visitors try to post, respond, or vote without being logged in-->
  <div class="dark hide" id="loginPlease">
    <div class="float">
        <p>Only registered users can post and vote in the forum. Sign up or log in to access these features!</p>
        <div class="text-center">
          <button class="btn1" id="exit" onclick="hide('loginPlease')">Got it</button>
        </div>
    </div>
  </div>

  <!-- This div is filled by "php/user/profileStatic.php" whenever someone clicks on a username -->
  <div id = "forumProfile"></div>
</div>

<script src="js/forum.js"></script>