<?php
  // This file generates the "menu" of posts on the main forum page.
  // Optionally takes a sorting parameter, otherwise sorts chronologically (newest first)
  // @author Isabel
  // Last modified 12/14/2020

  //If this is being called from forum.js
  if (isset($_GET["sortBy"])) {
    include "timeAgo.php";
    $sortMethod = $_GET["sortBy"];
    $posts = json_decode(file_get_contents("../../data/forum.json"), true);
  } else {
    $posts = json_decode(file_get_contents("data/forum.json"), true);
    $sortMethod = "active"; // default
  }

  //Sorting by active time (most recently active on top)
  if ($sortMethod == "active") {
    $postsUse = $posts;
    uasort($postsUse, function($a, $b) {
      return $b["active"] - $a["active"];
    });
    //Sorting by score -- if posts have same score most recently active goes on top
  } else if ($sortMethod == "score") {
    $postsUse = $posts;
    uasort($postsUse, function($a, $b) {
      $diff = $b["score"] - $a["score"];
      if ($diff) return $diff;
      return $b["active"] - $a["active"];
    });
    //Sorting by # of responses (lowest first) -- if posts have same most recently active goes on bottom
  } else if ($sortMethod == "responses") {
    $postsUse = $posts;
    uasort($postsUse, function($a, $b) {
      $diff = count($a["responses"]) - count($b["responses"]);
      if ($diff) return $diff;
      return $a["active"] - $b["active"];
    });
  }
?>

<table class="table">
  <tr>
    <th>Post score </th>
    <th>Responses</th>
    <th>Title</th>
    <th>Posted by</th>
    <th>Last activity</th>
  </tr>
  <?php
  //Output the overview info for each post
  foreach ($postsUse as $index => $post):
    $postActive = timeAgo($post["active"]);
  ?>
    <tr>
      <td><?= $post["score"]; ?></td>
      <td><?= count($post["responses"]); ?></td>
      <td><a onclick="openPost(<?= $index; ?>, 'forumHome')"> <?= $post["title"]; ?> </a></td>
      <td><?= $post["author"]; ?></td>
      <td><?= $postActive ?></td>
    </tr>
  <?php endforeach; ?>
</table>