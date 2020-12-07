<?php
  /* This file generates the list of responses to a given page.
  * Requires a post index. Optionally takes a sorting parameter,
  * otherwise sorts by score (highest ranked first)
  * @author Isabel
  * Last modified 12/7/2020
  */

  $sortMethod = "score"; // default

  //If this is being called from a forum.js function
  if (isset($_GET["sortBy"])) {
    session_start(); // doesn't have access to post.php variables
    // so must recalculate
    if (isset($_SESSION["username"])) {
      $loggedIn = true;
      $loggedStr = "true";
      $username = $_SESSION["username"];
      $isAdmin = $_SESSION["admin"];
    } else {
      $loggedIn = false;
      $loggedStr = "false";
    }

    $postIndex = $_GET["index"];
    $sortMethod = $_GET["sortBy"];
    $posts = json_decode(file_get_contents("../../data/forum.json"), true);
  }

  //Simple chronological order
  if ($sortMethod == "posted") {
    $responses = $posts[$postIndex]["responses"];
  //Sort by score -- if posts have same score newest goes on top
  } else if ($sortMethod == "score") {
    $responses = $posts[$postIndex]["responses"];
    uasort($responses, function($a, $b) {
      $diff = $b["score"] - $a["score"];
      if ($diff) return $diff;
      return $b["posted"] - $a["posted"];
    });
  } else {
    echo "Something's wrong.";
    exit;
  }
?>

<?php if (count($responses) == 0) : ?>
  <p class='alert alert-info' role='alert'>Nobody's responded to this post yet. Be the first!</p>
<?php else: ?>
  <table>
  <?php foreach($responses as $responseIndex => $response):
    // format posted time
    $posted = date('M j, Y \a\t h:iA', $response["posted"]);
    // can this user delete this response?
    $canDelete = $loggedIn & ($isAdmin || $username === $response["author"]);
  ?>
    <tr id='response<?= $responseIndex; ?>'>
      <td class='vote'><button class="btn1" type='button' onclick = "responseVote('<?= $loggedStr; ?>', 'up', <?= $postIndex; ?>, <?= $responseIndex; ?>)"><i class='fas fa-plus fa-xs'></i></button><br>
        <?= $response["score"]; ?><br>
        <button class="btn1" type='button' onclick="responseVote('<?= $loggedStr; ?>', 'down', <?= $postIndex; ?>, <?= $responseIndex; ?>)"><i class='fas fa-minus fa-xs'></i></button></td>
      <td><p><span class="author"><a onclick="openProfile('<?= $response["author"]; ?>', 'forumProfile', 'forumPost', 'response<?= $responseIndex; ?>')"><?=$response["author"]; ?></a></span><br>
      <span class='timestamp'><?= $posted; ?></span></p>
      <p class='postContent'><?= $response["content"]; ?></p></td>
    <?php if ($canDelete): ?>
        <td class = "deletePostResponse"><button class = "btn1" onclick = "showDeleteResponse(<?= $postIndex; ?>, <?= $responseIndex; ?>)"><i class="far fa-trash-alt"></i> Delete response</button></td>
      <?php endif; ?>
    </tr>
  <?php endforeach; ?>
  </table>

  <!-- confirmation div for response deletion -->
  <div id = "deleteResponse" class = "dark">
    <div class = "float">
      <p>Are you sure you want to delete this response? This action cannot be undone.<p>
      <button class = "btn1" id = "deleteRspBtn">Yes, delete response</button>
      <button class = "btn1" onclick = "hide('deleteResponse')">No, cancel</button>
    </div>
  </div>
<?php endif; ?>