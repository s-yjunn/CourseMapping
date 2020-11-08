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
      return $a["active"] - $b["active"];
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

<table>
  <?php
    if (count($responses) == 0) {
      echo "<p>Nobody's responded to this post yet. Be the first!</p>";
    } else {
      foreach($responses as $key => $value) {
        $posted = date('M j, Y \a\t h:i a \(\U\T\C\)', $value["posted"]);
          echo "<tr>
              <td class = 'vote'><button type='button' onclick=\"responseVote('$logged', 'up', $postIndex, $key)\">&#708;</button><br>"
              . $value["score"] . "<br>
              <button type='button' onclick=\"responseVote('$logged', 'down', $postIndex, $key)\">&#709;</button></td>
              <td><p>$posted<br>
                <span class = 'author'>" . $value["author"] . " said:</span>
                <p> " . $value["content"] . "</p></td>
            </tr>";
      }
    }
  ?>
</table>