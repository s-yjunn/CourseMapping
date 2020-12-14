<?php
  // This file formats a forum post given its index in the forum.json file
  // @author Isabel
  // Last modified 12/7/2020

  // get all posts (since this is called from outside forum proper)
  $posts = json_decode(file_get_contents("../../data/forum.json"), true);
  
  // Where is this post being requested from?
  $from = $_GET["from"];

  // Try to get the proper post
  $postIndex = $_GET['index'];
  // make sure the post hasn't been deleted since last refresh
  if (isset ($posts[$postIndex])) {
    // if not, get the post in qu)estion
    $post = $posts[$postIndex];
  } else {
    // give the visitor a back button and a message of deletion
    echo '<button class="btn1" type="button" onclick="hide(\'forumPost\'); show(\'forumHome\')"><i class="fas fa-arrow-left"></i> Back</button><br><br>';
    echo "Unable to load post -- it may have been deleted.";
    // end script
    exit;
  }

  // if all is well, save useful information about the post
  $posted = date('M j, Y \a\t h:iA', $post["posted"]);

  // determine current user
  // (needs to be recalculated because this is not included in index.php)
  session_start();
  if (isset($_SESSION["username"])) {
    $loggedIn = true;
    $loggedStr = "true";
    $username = $_SESSION["username"];
    $isAdmin = $_SESSION["admin"];
	} else {
    $loggedIn = false;
    $loggedStr = "false";
  }
  // can this user delete this post?
  $canDelete = $loggedIn & ($isAdmin || $username === $post["author"]);
?>

<button class="btn1" type="button" onclick="hide('forumPost'); show('<?= $from; ?>')"><i class="fas fa-arrow-left"></i> Back</button>


<!--The post itself-->
<div id="mainPost">
  <h4><?=$post["title"]; ?></h4>
  <table>
    <tr class="response">
      <td class="vote">
        <button class="btn1" type='button' onclick="postVote('<?=$loggedStr; ?>', 'up', <?=$postIndex; ?>)"><i class="fas fa-plus fa-xs"></i></button><br>
        <?=$post["score"]; ?><br>
        <button class="btn1" type='button' onclick="postVote('<?=$loggedStr; ?>', 'down', <?=$postIndex; ?>)"><i class="fas fa-minus fa-xs"></i></button>
      </td>
      <td>
        <p><span class="author"><a onclick="openProfile('<?= $post["author"]; ?>', 'forumProfile', 'forumPost', '')"><?=$post["author"]; ?></a></span><br>
        <span class="timestamp"><?=$posted; ?></span></p>
        <p class="postContent"><?=$post["content"]; ?></p>
      </td>
      <?php if ($canDelete): ?>
        <td class = "deletePostResponse float-right"><button class = "btn1" onclick = "show('deletePost')"><i class="far fa-trash-alt"></i></button></td>
      <?php endif; ?>
    </tr>
  </table>
</div>

<!-- div to confirm post deletion (hidden) -->
<?php if ($canDelete): ?>
  <div id = "deletePost" class = "dark">
    <div class = "float">
      <p>Are you sure you want to delete this post? This action cannot be undone.<p>
      <button class = "btn1" onclick = "deletePost(<?= $postIndex; ?>)">Yes, delete post</button>
      <button class = "btn1" onclick = "hide('deletePost')">No, cancel</button>
    </div>
  </div>
<?php endif; ?>

<!-- all stuff related to post responses-->
<div id="postResponses">
  <h5>Responses</h5>
  <!-- selector for how to sort responses -->
	<form>
    <label for='responsesView'>Sort by: </label>
    <select id='responsesView' onchange='sortPostResponses(<?=$postIndex; ?>, this.value)'>>
      <option value='score'>Highest ranked</option>
      <option value='posted'>Oldest</option>
    </select>
	</form>
  
  <!--Existing responses-->
  <div id="responseList">
    <?php
      include "responseList.php";
    ?>  
  </div>
</div>

<!--Form to write a new response-->
<div id="composeResponse">
	<h5>Your Response</h5>
	<textarea id='responseContent' placeholder='Write your response here.'></textarea><br>
	<button class="btn1" type='button' onclick="postResponse('<?=$loggedStr; ?>', <?=$postIndex; ?>)">Post</button><br>
	<span id = 'responseStatus'></span>
</div>