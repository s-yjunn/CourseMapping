<!-- the built-in "user manual"
@author text of manual written by all, this file mostly by Isabel + Alexis on style -->

<button class = 'close' onclick = 'hide("Help")'><i class="fa fa-times"></i></button>

<h2>Help</h2>

<div id = "helpHome" class="refresh">
  <p><button class="btn1"onclick = "hide('helpHome'); show('helpManual')">How do I use this site?</button>
  <button class="btn1" onclick = "hide('helpHome'); show('helpAdmin')">I want to message the admin.</button></p>
</div>

<div id = "helpAdmin" class="refresh">
  <img src="imgs/quizzes/backbutton.jpg" alt="back button" class="backBtnImg" onclick="hide('helpAdmin'); show('helpHome')"><br><br>
  
  <form>
    <textarea id = "msgAdminHelp" placeholder = "Write your message to site admin"></textarea><br>
    <button type = "button" class = "btn1" onclick = "messageToAdmin('msgAdminHelp', 'msgAdminHelpFB' <?php if ($loggedIn) { echo ", '$username'"; } ?>)">Send</button><br><br>
    <span id = "msgAdminHelpFB"></span>
  </form>
</div>

<div id = "helpManual" class="refresh">
  <img src="imgs/quizzes/backbutton.jpg" alt="back button" class="backBtnImg" onclick="hide('helpManual'); show('helpHome')"><br><br>
  <p>These instructions are organized by tab. We hope they are helpful! If you find an error or point of confusion, don’t hesitate to go "back" and send a message to our wonderful site administrators.</p>

  <hr>

  <h4>Featured</h4>
  <p>Click on an item that appeals to you to see the full pattern, containing instructions for how to create that item.</p>

  <hr>

  <h4>Contest</h4>
  <p>Here you can participate in picking the patterns for our next "featured" slideshow.</p>

  <h5>Enter the contest (logged-in users only)</h5>
  <p>Once you have logged into your account, under the "Contest" tab. There is a section that says "Enter the Contest" at the top of the page. Under the description, there is a text box to input the title of your submission. Under the text box, there is a "Choose Files" button. When you press it, you will be prompted to select your files. <b>Please only submit one text file of pattern-making instructions and one image.</b>. Be sure to use html syntax for any formatting in your text file. Once you have entered a title and chosen your files, press the "Submit" button. The admin will review your submission for admission as soon as possible. If your submission was not reviewed in this competition cycle, it will be added to the next one.</p>

  <h5>View contestants and vote</h5>
  <p>Below the "Enter contest" section you will see a display of the current slideshow candidates. Click "View pattern" under a thumbnail that appeals to you to see the full pattern, containing instructions for how to create that item.</p>

  <p>Take your time looking through the patterns. Once you've found your favorite, click "Vote" button underneath its thumbnail to add your vote to it.</p>

  <hr>

  <h4>Pattern maker</h4>
  <p>In this tab you can create a grid-based pattern for your next knitting project.</p>
  <h5>Getting started</h5>
  <p>When you first open the tab you will be prompted to enter the dimensions of your project. Because our pattern maker only supports square patterns right now, enter whichever number is larger: the number of rows in your project, or the number of stitches per row. The minimum value is 6, and the maximum is 30. After you enter a valid number and click "Launch pattern maker", you will be taken to a blank pattern with your specifications.</p>

  <h5>Making a pattern</h5>
  <p>Click and drag inside a square on the grid to fill the square. Click a colored rectangle on the sidebar to change the fill color. Click the bottom-most colored rectangle to access a color picking tool for finer color selection beyond than the default color options. To erase your pattern and restart from a blank grid, click "Clear canvas." To start over completely with new grid dimensions, click "Start over."</p>

  <h5>Saving your pattern</h5>
  <p>Click "download" to save your pattern as an image on your computer or mobile device.</p>
  <p>If you are logged in, click "Save to my account" to save your pattern as an image on our server, which you can access anytime you’re logged in by going to "My account -> Patterns". There you can download your pattern, make it visible on your public profile, or delete it.</p>

  <hr>

  <h4>Quizzes</h4>
  <p>Under the "Quizzes tab", there is a list available quizzes for you to take. Press the title that appeals to you, answer all of the questions, and see what you get!</p>

  <hr>

  <h4>Forum</h4>
  <p>When you first open the forum you will see a table containing all posts, with the most recently active on top. Click "refresh" to check for newer posts. Click on the dropdown next to "Sort by" to view the same list with the highest-ranked posts on top, or with the unanswered posts on top. Click on a post title to view it and any responses to it, with the highest ranking ones on top. Click on the dropdown next to "Sort by" in the responses section to see them in chronological order instead. If you are logged in, click the + or - icons next to a post's body or response to upvote or downvote it, adding to or subtracting from its rank.</p>

  <h5>Searching the forum</h5>
  <p>If you have a question about knitting and want to see if it’s been answered before, or aren’t registered and can’t post yourself, enter a keyword or phrase in the "Search the forum…" bar and click "Search" to view a list of posts whose title or content contains your query, with the highest ranked ones on top. Click the drop-down next to "Sort by" to view the most recently active or most-highly responded to results first instead.</p>

  <h5>Posting and deleting (logged-in users only)</h5>
  <p>Click "Write a post" on the forum homepage to compose a post. Write your post, including a title, then click "Post" to add it to the forum. If successful, you will see it appear at the top of the "Active" ranking. If not, you will see a helpful error message.</p>
  <p>Scroll to the bottom of a post’s responses to add your own. Write your response in the composition box and click "Post" to add it to the response list. If successful, it will appear immediately. If not, you will see a helpful error message.</p>
  <p>If you realize you’ve made a mistake, or just don’t want the world to see your post or response anymore, make sure you’re logged in, go to your post or response and click the <i class="far fa-trash-alt"></i> button to delete it. Once you’ve deleted a post of response, it can’t be recovered, but you will be prompted to confirm before permanent deletion, so don’t worry about clicking this by accident.</p>
  <p>Site administrators can delete any post or response in the forum. But they will only do that for something that violates reasonable standards of decorum or relevance.</p>

  <hr>

  <h4>Log in</h4>
  <p>This page allows returning users to enter their account credentials. If correctly entered, users are successfully logged into their account and returned to the homepage. If incorrectly entered, users are prompted with an error message preventing login.</p>

  <hr>

  <h4>Sign up</h4>
  <p>This page allows new users to create a unique account by entering their desired account credentials. If visitors attempt to register with an existing username or do not enter matching passwords, they are prompted with an error message. Otherwise, if account credentials are available and correct, a user account is successfully created and the user is returned to the homepage.</p>

  <?php if ($loggedIn): ?>
  <hr>

  <h4>My Account</h4> <!-- I’ll make this only visible to logged in users… ? -->
  <p>When you open this tab you will see three options:</p>
  <h5>Inbox</h5>
  <p>This page is where you will see any messages sent to you by site administrators. Each time you open it it will be updated, and you can also click the <i class="fas fa-redo-alt fa-xs"></i> button to check for new messages while it’s open.</p>
  <p>Click the <i class="fas fa-envelope fa-xs"></i> button to send a message to site admin.</p>

  <h5>Profile</h5>
  <p>This page allows you to view and customize your public profile, which will be visible to other users if you post or respond to posts in the forum.</p>
  <p>Click on your profile picture to upload a new one.</p>
  <p>Click the <i class="fas fa-pencil-alt fa-xs"></i> button to the right of "About me" to edit your description. Add a favorite thing to knit or another fun fact about yourself!</p>

  <h5>Patterns</h5>
  <p>This page allows you to manage your saved patterns. Click on a pattern to access your options:</p>
  <ul>
    <li><u>Change privacy level:</u> the red-highlighted "Public" or "Private" tag you see above your pattern indicates whether it is visible to other users on your public profile ("Public") or not ("Private"). Click on it to toggle between the two options. If you are satisfied with your change, click the "Save" button that appeared below to save the change, or "Cancel" to restore the previous visibility level.</li>
    <li><u>Download:</u> click the "Download" button (you may have to scroll down to see it) saves a copy of your pattern to your computer or mobile device.</li>
    <li><u>Delete:</u> click the "Delete" button to delete the pattern from our server. Once deleted, your pattern cannot be recovered. You will be asked to confirm before deleting, though, so don’t worry about clicking this by accident.</li>
  </ul>

  <?php endif; ?>

  <?php if ($loggedIn && $isAdmin): ?>

  <hr>

  <h4>Manage Site</h4> <!-- I’ll make this only visible to admins -->
  <p>When you open this tab you will see three options: </p>
  <h5>Inbox</h5>
  <p>This page is where you will see any messages sent to you by site visitors. Each time you open it it will be updated, and you can also click the <i class="fas fa-redo-alt fa-xs"></i> button to check for new messages while it’s open.</p>
  <p>You can send messages to registered users in the "Users" page.</p>

  <h5>Users</h5>
  <p>This page gives you an overview of Knitty Gritty’s registered users, including the number of users and date of registration, role (admin or regular user), and total number of saved patterns (public and private).</p>
  <p>Click the <i class="fas fa-redo-alt fa-xs"></i> button to refresh the table of users. Click the "View profile" button of an entry to see their public profile. Click the "Message" button to send them a message. It’s polite to do this if you’ve deleted their post in the forum or something.</p>

  <h5>Contest</h5>
  <p>This page is where you can manage the pattern contest. Throughout the page, click on a pattern’s title to view it in full. Your options are:</p>
  <ul>
    <li><u>Approve submissions:</u> to approve a submission, <b>under the bulleted submissions</b>, there is a list of the submissions. Click on the desired submission. <b>Press Ctr + Click  or Click + Drag to select multiple submissions</b>. Once you have selected all of the desired submissions, press "Approve." You will see the updated list of approved submissions under "Preview Winners".</li>

    <li><u>Delete submissions:</u> to delete a submission, <b>under the bulleted submissions</b>, there is another copy of the submission list. Click on the desired submission. <b>Press Ctr + Click  or Click + Drag to select multiple submissions</b>. Once you have selected all of the desired submissions, press "Delete."</li>

    <li><u>Select winners and end this round of competition:</u> under "Preview Winners", there is a list of all approved submissions. Under the list, there is a text box. Type the number of winners you want there to be, the press the "Preview Winners" button. A slideshow will appear of what the "Featured" page will look like if you confirm. <b>Note:</b> if there is a tie, or if there are not enough <b>valid submissions</b>, you may get more or fewer winners than what you requested. A submission without votes does <b>not</b> count as a valid submission.<br><br>If you are satisfied with the preview, press the "Confirm Winners" button. This will reset the competition and erase all submissions that did not win. The <b>unapproved</b> submissions will <b>not</b> be affected.</li>
  </ul>
  <?php endif; ?>

</div>