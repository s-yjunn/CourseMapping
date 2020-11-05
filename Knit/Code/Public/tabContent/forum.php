<?php
	//Just setting this manually for testing; later it'll be a session variable
  $username = "Isabel";

  //Getting all the existing posts from our json file
  $posts = json_decode(file_get_contents("data/forum.json"), true);
?>
<div id="Forum" class="tabcontent">
	<div class="card">
    <h3>Forum</h3>
    <!--This div is what the user sees when they first open the forum-->
    <div id="forumHome">
      <button type="button" onclick="show('composePost')">Make a new post</button>
      <!--This div contains a form to compose a post. It should be hidden ordinarily and shown when the user hits the "make a new post" button-->
      <div class="dark" id="composePost">
        <div class="float">
          <h4>Compose post</h4>
            <input type="text" id="postTitle" placeholder="Your post's title"><br>
            <textarea id = "postContent" placeholder="Your post's content"></textarea><br>
            <button type="button" onclick="postPost('<?=$username; ?>')">Post</button>           
          <button id="close" onclick="hide('composePost')">Cancel</button>
        </div>
      </div>

      <!--This is the forum "menu": a table of links to existing forum posts-->
      <h4>All posts</h4>
      <table>
      <tr>
        <!--We can get rid of these titles later, just for clarity now-->
        <th>Post score (upvotes-downvotes)</th>
        <th>Title</th>
        <th>Posted by</th>
      </tr>
        <?php
          //Loop through the posts and get overview information
          foreach ($posts as $key => $value) {
            echo "<tr>
              <td>" . $value["score"] .  "</td>
              <td><a onclick=\"hide('forumHome'); show('$key');\">" . $value["title"] . "</a></td>
              <td>" . $value["author"] . "</td>
            </tr>";
          }
        ?>
      </table>
    </div>      

    <!--The following divs are the posts themselves, which should be hidden ordinarily and shown when a user clicks on the title of a post -->
    <?php
      //Loop through the posts and make a div for each of them
      foreach ($posts as $key => $value) {
        echo "<div id='$key' class='forumPost'>
        <p><a onclick=\"hide('$key'); show('forumHome')\">Return to forum menu</a></p>
        <h4>" . $value["title"] . "</h4>
        <p>by " . $value["author"] .  "</p>
        <p>" . $value["content"] . "</p>";
        echo "<p>Comments will go here in the next dev phase.</p>";
        echo "</div>";
      }
    ?>
	</div>
</div>

<script src="js/forum.js"></script>
<script src="js/showHide.js"></script>