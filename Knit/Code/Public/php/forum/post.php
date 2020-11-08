<?php
  //This file formats a forum post given its index in the json file

  //Get all posts (since this is called from outside forum proper)
  $posts = json_decode(file_get_contents("../../data/forum.json"), true);
  
  //Get the proper post
  $postIndex = $_GET['index'];
  $post = $posts[$postIndex];
  $responses = $post['responses'];

  //And save useful information about it
  $postDateTime = date('M j, Y \a\t h:i a', $post["time"]);

  //Set what do do when vote and postResponse buttons are clicked
  session_start();
  if (isset($_SESSION['username'])) {
    $logged = "true";
  } else {
    $logged = "false";
  }

?>

<div id="mainPost">
  <p><a onclick="hide('forumPost'); show('forumHome')">Return to forum menu</a></p>
  <h4><?=$post["title"]; ?></h4>
  <table>
    <tr>
      <td class="vote"><button type='button' onclick="postVote('<?=$logged; ?>', 'up', <?=$postIndex; ?>)">&#708;</button><br>
      <?=$post["score"]; ?><br>
      <button type='button' onclick="postVote('<?=$logged; ?>', 'down', <?=$postIndex; ?>)">&#709;</button></td>
      <td>
        <p><?=$postDateTime; ?><br>
        <span class = "author"><?=$post["author"]; ?> said:</span></p>
        <p><?=$post["content"]; ?></p>
      </td>
    </tr>
  </table>
</div>

<div id="postResponses">
  <h5><?=count($responses); ?> response(s)</h5>
  <!--Selector for how to sort responses-->
  <form>
    <label for="responsesView">Sort by:</label>
    <select id="responsesView" onchange="sortPostResponses(<?=$postIndex; ?>, this.value)">>
      <option value="score">Highest ranked first</option>
      <option value="time">Oldest first</option>
    </select>
  </form>

<!--existing responses go here-->
<div id="responseList">
  <?php
    include "responseList.php";
  ?>  
</div>

  <!--Form to write a response-->
<div id="composeResponse">
  <h5>Your response</h5>
  <textarea id = 'responseContent' placeholder='Write your response here.'></textarea><br>
  <button type='button' onclick="postResponse('<?=$logged; ?>', <?=$postIndex; ?>)">Post</button>
  <span id = 'responseStatus'></span>
</div>