<?php
  //This file formats a forum post given its index in the json file

  //Get all posts (since this is called from outside forum proper)
  $posts = json_decode(file_get_contents("../../data/forum.json"), true);
  
  //Get the proper post
  $postIndex = $_GET['index'];
  $post = $posts[$postIndex];
  $responses = $post['responses'];

  //And save useful information about it
  $posted = date('M j, Y \a\t h:iA', $post["posted"]);

  //Set what do do when vote and postResponse buttons are clicked
  session_start();
  if (isset($_SESSION['username'])) {
    $logged = "true";
  } else {
    $logged = "false";
  }
?>

<button type="button" onclick="hide('forumPost'); show('forumHome')"><i class="fas fa-arrow-left"></i> Return to forum menu</button>


<!--The post itself-->
<div id="mainPost">
  <h4><?=$post["title"]; ?></h4>
  <table>
    <tr class="response">
      <td class="vote"><button type='button' onclick="postVote('<?=$logged; ?>', 'up', <?=$postIndex; ?>)"><i class="fas fa-plus fa-xs"></i></button><br>
      <?=$post["score"]; ?><br>
      <button type='button' onclick="postVote('<?=$logged; ?>', 'down', <?=$postIndex; ?>)"><i class="fas fa-minus fa-xs"></i></button></td>
      <td>
        <p><span class="author"><?=$post["author"]; ?></span><br>
        <span class="timestamp"><?=$posted; ?></span></p>
        <p class="postContent"><?=$post["content"]; ?></p>
      </td>
    </tr>
  </table>
</div>

<!-- all stuff related to post responses-->
<div id="postResponses">
  <h5>Responses</h5>
  <!-- selector for how to sort responses -->
	<form>
	    <label for='responsesView'>Sort by: </label>
	    <select id='responsesView' onchange='sortPostResponses(<?=$postIndex; ?>, this.value)'>>
	      <option value='score'>Highest ranked first</option>
	      <option value='posted'>Oldest first</option>
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
	<h5>Your response</h5>
	<textarea id='responseContent' placeholder='Write your response here.'></textarea><br>
	<button type='button' onclick="postResponse('<?=$logged; ?>', <?=$postIndex; ?>)">Post</button>
	<span id = 'responseStatus'></span>
</div>