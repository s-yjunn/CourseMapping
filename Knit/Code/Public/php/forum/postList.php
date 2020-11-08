<?php
  //This file generates the "index" of posts on the main forum page. Optionally takes a sorting parameter, otherwise sorts chronologically (newest first)

  //If this is being called from forum.js
  if (isset($_GET["sortBy"])) {
    $sortMethod = $_GET["sortBy"];
    $posts = json_decode(file_get_contents("../../data/forum.json"), true);
  } else {
    $posts = json_decode(file_get_contents("data/forum.json"), true);
    $sortMethod = "time"; // default
  }

  if ($sortMethod == "time") {
    $postsUse = array_reverse($posts, true); 
  } else if ($sortMethod == "score") {
    $postsUse = $posts;
    uasort($postsUse, function($a, $b) {
        return $b["score"] - $a["score"];
    });
  } else if ($sortMethod == "responses") {
    $postsUse = $posts;
    uasort($postsUse, function($a, $b) {
      return count($a["responses"]) - count($b["responses"]);
  });
  }
?>

<table>
  <tr>
    <!--We can get rid of these titles later, just for clarity now-->
    <th>Post score </th>
    <th>Responses</th>
    <th>Title</th>
    <th>Posted by</th>
    <th>Time (UTC)</th>
  </tr>
    <?php
    //Output the overview info for each post
    foreach ($postsUse as $key => $value) {
      $postDateTime = date('M j, Y \a\t h:i a', $value["time"]);
      echo "<tr>
        <td>" . $value["score"] . "</td>
        <td>" . count($value["responses"]) .  "</td>
        <td><a onclick=\"openPost($key)\">" . $value["title"] . "</a></td>
        <td>" . $value["author"] . "</td>
        <td>$postDateTime</td>
      </tr>";
    }
    ?>
</table>