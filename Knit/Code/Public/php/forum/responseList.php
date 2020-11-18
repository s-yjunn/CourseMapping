<?php
  //This file generates the list of responses to a given page. Requires a post index. Optionally takes a sorting parameter, otherwise sorts chronologically (newest first)
  //Default sort order is by score
  $sortMethod = "score";

  //If this is being called from a forum.js function
  if (isset($_GET["sortBy"])) {
    session_start();
    $postIndex = $_GET["index"];
    $sortMethod = $_GET["sortBy"];
    $posts = json_decode(file_get_contents("../../data/forum.json"), true);
  }

  //Simple chronological order
  if ($sortMethod == "posted") {
    $responses = $posts[$postIndex]["responses"];
  //Sort by score -- if posts have same score oldest goes on top
  } else if ($sortMethod == "score") {
    $responses = $posts[$postIndex]["responses"];
    uasort($responses, function($a, $b) {
      $diff = $b["score"] - $a["score"];
      if ($diff) return $diff;
      return $a["posted"] - $b["posted"];
    });
  } else {
    echo "Something's wrong.";
    exit;
  }

  //Set what do do when vote buttons are clicked
  if (isset($_SESSION['username'])) {
    $logged = "true";
  } else {
    $logged = "false";
  }
?>

<?php if (count($responses) == 0) : ?>
      <p class='alert alert-info' role='alert'>Nobody's responded to this post yet. Be the first!</p>
<?php else: ?>
  <table>
  <?php foreach($responses as $key => $value):
    $posted = date('M j, Y \a\t h:iA', $value["posted"]);
  ?>
    <tr class='response'>
      <td class='vote'><button type='button' onclick = "responseVote('<?= $logged; ?>', 'up', <?= $postIndex; ?>, <?= $key; ?>)"><i class='fas fa-plus fa-xs'></i></button><br>
        <?= $value["score"]; ?><br>
        <button type='button' onclick="responseVote('<?= $logged; ?>', 'down', <?= $postIndex; ?>, <?= $key; ?>)"><i class='fas fa-minus fa-xs'></i></button></td>
      <td><p><span class='author'><?= $value["author"]; ?></span><br>
      <span class='timestamp'><?= $posted; ?></span></p>
      <p class='postContent'><?= $value["content"]; ?></p></td>
    </tr>
  <?php endforeach; ?>
  </table>
<?php endif; ?>