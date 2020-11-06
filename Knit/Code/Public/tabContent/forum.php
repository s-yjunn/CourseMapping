<?php
  //Getting all the existing posts from our json file
  $posts = json_decode(file_get_contents("data/forum.json"), true);
?>
<div id="Forum" class="tabcontent">
	<div class="card">
    <h3>Forum</h3>
    <!--This div is what the user sees when they first open the forum-->
    <div id="forumHome">
      <button type="button" onclick="updateForum()">Refresh</button>
      <?php
        // if the user's logged in, show the compose button (this needs work -- rn you have to reload the page)
        session_start();
        if (isset($_SESSION["username"])) {
          echo "<button type=\"button\" onclick=\"show('composePost')\">Write a post</button>";
        //Otherwise, encourage them to log in
        } else {
          echo "<p>Log in or sign up and refresh the page to post in the forum!</p>";
        }
      ?>
      
      <!--Status updates go here-->
      <span id = "forumStatus"></span>

      <!--This div contains a form to compose a post. It should be hidden ordinarily and shown when the user hits the "make a new post" button-->
      <div class="dark" id="composePost">
        <div class="float">
          <h4>Compose post</h4>
          <input type="text" id="postTitle" placeholder="Your post's title"><br>
          <textarea id = "postContent" placeholder="Your post's content"></textarea><br>
          <button type="button" onclick="postPost()">Post</button>           
          <button id="cancel" onclick="hide('composePost')">Cancel</button>
          <span id = "postStatus"></span> <!-- for validation of a post-->
        </div>
      </div>

      <!--This is the forum "menu": a table of links to existing forum posts-->
      <div id = "forumMenu">
        <h4>All posts</h4>
        <table>
        <tr>
          <!--We can get rid of these titles later, just for clarity now-->
          <th>Post score </th>
          <th>Responses</th>
          <th>Title</th>
          <th>Posted by</th>
        </tr>
          <?php
            //Loop through the posts and get overview information and a "link" to each post
            foreach ($posts as $key => $value) {
              echo "<tr>
                <td>" . $value["score"] . "</td>
                <td>" . count($value["responses"]) .  "</td>
                <td><a onclick=\"hide('forumHome'); show('post$key');\">" . $value["title"] . "</a></td>
                <td>" . $value["author"] . "</td>
              </tr>";
            }
          ?>
        </table>
      </div>
    </div>      

    <!--The following div contains the posts themselves, which should be hidden ordinarily and shown when a user clicks on the title of a post -->
    <div id = "forumPosts">
      <?php
        //Loop through the posts and make a div for each of them
        foreach ($posts as $key => $value) {
          //The post itself
          $postIndex = $key;
          echo "<div id='post$postIndex' class='forumPost'>
            <div class = 'mainPost'>
              <p><a onclick=\"hide('post$key'); show('forumHome')\">Return to forum menu</a></p>
              <h4>" . $value["title"] . "</h4>
              <table>
                <tr>
                  <td class='vote'><button type='button' onclick=\"postVote('up', $postIndex)\">&#708;</button><br>" . $value["score"] . "<br><button type='button' onclick=\"postVote('down', $postIndex)\">&#709;</button></td>
                  <td><p class = 'author'>" . $value["author"] . " said:</p>
                    <p> " . $value["content"] . "</p></td>
                </tr>
              </table>
            </div>";

            // Loop through any responses to the post and make a table entry for each one
            echo "<div class='forumResponses'>
              <h5>". count($value["responses"])." responses</h5>
              <table>";
                foreach($value["responses"] as $key => $value) {
                  echo "<tr>
                      <td class = 'vote'><button type='button' onclick=\"responseVote('up', $postIndex, $key)\">&#708;</button><br>" . $value["score"] . "<br><button type='button' onclick=\"responseVote('down', $postIndex, $key)\">&#709;</button></td>
                      <td><p class = 'author'>" . $value["author"] . " said:</p>
                        <p> " . $value["content"] . "</p></td>
                    </tr>";
                }
              echo "</table>";

              //Response submission
              echo "<div class='composeResponse'>
                <h5>Your response</h5>
                <textarea id = 'responseContent$postIndex' placeholder='Write your response here.'></textarea><br>
                <button type='button' onclick='postResponse(" . $postIndex . ")'>Post</button>
                <span id = 'responseStatus$postIndex'></span>
              </div>";
            
            echo "</div>";
          echo "</div>";
        }
      ?>
    </div>
	</div>
</div>

<script src="js/forum.js"></script>