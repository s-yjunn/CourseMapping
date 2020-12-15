<?php
  // This file generates the "Inbox" page (loaded into the admin tab)
  // all admins access the same admin inbox
  // @author Isabel
  // Last modified 12/14/2020

  $path = "../../../Private/adminMessages.json";

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

<button class="btn1" onclick="hide('adminInbox'); show('adminHome')"><i class="fas fa-arrow-left"></i> Back</button><br><br>

<div id = "userInboxContent">
  <h4>Inbox <button class="btn1 btnIcon float-right" type="button" onclick="refreshAdminInbox()"><i class="fas fa-redo-alt fa-xs"></i></button></h4>
  
  <div class="refresh">
  <!--reload button.-->
  <div id = "userUnreadMsg" class = "section">
    <h5>Unread messages</h5>
    <?php if (count($unread) == 0):?>
      <p class='alert alert-info' role='alert'>No new messages.</p>
    <?php else: ?>
      <?php foreach ($unread as $message):
        $sent = date('M j, Y \a\t h:iA \U\T\C', $message["sent"]);
        if (!$from = $message["from"]) {
          $from = "ANONYMOUS";
        }
      ?>
        <div class="message">
          <p class="author"><?= $from; ?><br>
          <span class="timestamp"><?= $sent; ?></span>
            <?php if ($message["answered"]): ?>
              | ANSWERED
            <?php endif; ?>
          </span></p>
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
        if (!$from = $message["from"]) {
          $from = "ANONYMOUS";
        }
      ?>
	  <div class="message">
        <p class="author"><?= $from; ?><br>
        <span class="timestamp"><?= $sent; ?>
          <?php if ($message["answered"]): ?>
            | ANSWERED
          <?php endif; ?>
        </span></p>
        <p class="messageContent"><?= $message["text"]; ?></p>
	  </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
  </div>
  
</div>