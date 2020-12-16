<?php
  /* This file processes and outputs the result of a forum search.
  Sorted by score by default, but optionally takes a sorting parameter
  @author Isabel
  Last modified 12/14/2020 */

  // get time formatting library
  include "timeAgo.php";

  // get search query
  $param = $_POST["param"];

  // get sort method
  $sortMethod = $_POST["sortBy"];

  // get posts
  $posts = json_decode(file_get_contents("../../data/forum.json"), true);

  $result = [];
  //search posts -- loop through them
  foreach ($posts as $post) {
    // and if query is in post title or post content, add them to the search result
    // (stripos is case-insensitive)
    if (stripos($post["title"], $param) !== false || stripos($post["content"], $param) !== false) {
      $result[] = $post;
    }
  }

  // sort result
  //Sorting by active time (most recently active on top)
  if ($sortMethod == "active") {
    uasort($result, function($a, $b) {
      return $b["active"] - $a["active"];
    });
    //Sorting by score -- if posts have same score most recently active goes on top
  } else if ($sortMethod == "score") {
    uasort($result, function($a, $b) {
      $diff = $b["score"] - $a["score"];
      if ($diff) return $diff;
      return $b["active"] - $a["active"];
    });
    //Sorting by # of responses (highest first) -- if posts have same most recently active goes on top
  } else if ($sortMethod == "responses") {
    uasort($result, function($a, $b) {
      $diff = count($b["responses"]) - count($a["responses"]);
      if ($diff) return $diff;
      return $b["active"] - $a["active"];
    });
  }
?>

<?php if (count($result) == 0):?>
  <p>No results.</p>
<?php else: ?>
  <table class="table">
    <tr>
      <th>Post score </th>
      <th>Responses</th>
      <th>Title</th>
      <th>Posted by</th>
      <th>Last activity</th>
    </tr>
    <?php
    //Output the overview info for each result
    foreach ($result as $index => $post):
      $postActive = timeAgo($post["active"]);
    ?>
      <tr>
        <td><?= $post["score"]; ?></td>
        <td><?= count($post["responses"]); ?></td>
        <td><a onclick="openPost(<?= $index; ?>, 'forumSearch')"> <?= $post["title"]; ?> </a></td>
        <td><?= $post["author"]; ?></td>
        <td><?= $postActive ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
<?php endif; ?>