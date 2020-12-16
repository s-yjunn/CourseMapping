<?php
  // This file generates the "Inbox" page (loaded into the user account tab)
  // @author Isabel
  // Last modified 12/14/2020

  $username = $_GET["uname"];

  $path = "../../../Private/$username/messages.json";

  $messages = json_decode(file_get_contents($path), true);

  // get the current list of messages
  $unread = $messages["unread"];
  $read = $messages["read"];

  // move the unreads to "read" for next time
  $messages["unread"] = [];
  $messages["read"] = array_merge($unread, $read);

  // update the json file
  file_put_contents($path, json_encode($messages));
?>

<img src="imgs/quizzes/backbutton.jpg" alt="back button" class="backBtnImg" onclick="hide('userInbox'); show('userHome')"><br><br>

<div id = "userInboxContent">
  <h4>Inbox<button class="btn1 btnIcon float-right" type="button" onclick="refreshUserInbox('<?= $username; ?>')"><i class="fas fa-redo-alt fa-xs"></i></button></h4>
  <button class="btn1" type="button" onclick="show('userCompose')">Message admin</button>
  
  <div class="refresh">
  <!--reload button.-->
  <div id = "userUnreadMsg" class = "section">
    <h5>Unread messages</h5>
    <?php if (count($unread) == 0):?>
      <p class='alert alert-info' role='alert'>No new messages.</p>
    <?php else: ?>
      <?php foreach ($unread as $message):
        $sent = date('M j, Y \a\t h:iA \U\T\C', $message["sent"]);
      ?>
	  <div class="message">
        <p class="author"><?= $message["from"]; ?><br>
        <span class="timestamp"><?= $sent; ?></span></p>
        <p class="messageContent"><?= $message["text"]; ?></p>
	  </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <div id = "userReadMsg" class = "section">
    <h5>Read messages</h5>
    <?php if (count($read) == 0):?>
      <p class='alert alert-info' role='alert'>No old messages.</p>
    <?php else: ?>
      <?php foreach ($read as $message):
        $sent = date('M j, Y \a\t h:iA', $message["sent"]);
      ?>
	  <div class="message">
        <p class="author"><?= $message["from"]; ?><br>
        <span class="timestamp"><?= $sent; ?></span></p>
        <p class="messageContent"><?= $message["text"]; ?></p>
	  </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
  </div>
</div>

<div id = "userCompose" class = "dark">
  <div class = "float">
    <button class = 'close' onclick = "hide('userCompose')"><i class="fa fa-times"></i></button><br><br>
    <textarea id = "msgAdminInbox" placeholder = "Write your message to site admin"></textarea><br><br>
    <button class = "btn1" onclick = "messageToAdmin('msgAdminInbox', 'msgAdminInboxFB', '<?= $username; ?>')">Send</button> <button class = "btn1" onclick = "cancelUserCompose()">Cancel</button><br><br>
    <span id = "msgAdminInboxFB"></span>
  </div>
</div>