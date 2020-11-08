<?php
  //Default sort order is by score
  $sortMethod = "score";

  //If this is being called from a forum.js function
  if (isset($_GET["sortBy"])) {
    session_start();
    $postIndex = $_GET["index"];
    $sortMethod = $_GET["sortBy"];
    $posts = json_decode(file_get_contents("../../data/forum.json"), true);
  }

  if ($sortMethod == "time") {
    $responses = $posts[$postIndex]["responses"];
  } else if ($sortMethod == "score") {
    $responses = $posts[$postIndex]["responses"];
    uasort($responses, function($a, $b) {
      return $b["score"] - $a["score"];
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
    foreach($responses as $key => $value) {
    $postDateTime = date('M j, Y \a\t h:i', $value["time"]);
      echo "<tr>
          <td class = 'vote'><button type='button' onclick=\"responseVote('$logged', 'up', $postIndex, $key)\">&#708;</button><br>"
          . $value["score"] . "<br>
          <button type='button' onclick=\"responseVote('$logged', 'down', $postIndex, $key)\">&#709;</button></td>
          <td><p>$postDateTime<br>
            <span class = 'author'>" . $value["author"] . " said:</span>
            <p> " . $value["content"] . "</p></td>
        </tr>";
    }
  ?>
</table>