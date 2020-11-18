<?php
  //This file generates the "index" of posts on the main forum page. Optionally takes a sorting parameter, otherwise sorts chronologically (newest first)

  //If this is being called from forum.js
  if (isset($_GET["sortBy"])) {
    include "timeAgo.php";
    $sortMethod = $_GET["sortBy"];
    $posts = json_decode(file_get_contents("../../data/forum.json"), true);
  } else {
    $posts = json_decode(file_get_contents("data/forum.json"), true);
    $sortMethod = "active"; // default
  }

  //Sotring by active time (most recently active on top)
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
    //Sorting by # of responses -- if posts have same most recently active goes on bottom
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
    <!--We can get rid of these titles later, just for clarity now-->
    <th>Post score </th>
    <th>Responses</th>
    <th>Title</th>
    <th>Posted by</th>
    <th>Last activity</th>
  </tr>
  <?php
  //Output the overview info for each post
  foreach ($postsUse as $key => $value):
    $postActive = timeAgo($value["active"]);
  ?>
    <tr>
      <td><?= $value["score"]; ?></td>
      <td><?= count($value["responses"]); ?></td>
      <td><a onclick="openPost(<?= $key; ?>)"> <?= $value["title"]; ?> </a></td>
      <td><?= $value["author"]; ?></td>
      <td><?= $postActive ?></td>
    </tr>
  <?php endforeach; ?></table>