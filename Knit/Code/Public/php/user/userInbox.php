<?php
  // This file generates the "Inbox" page (included within the user account tab)
  // @author Isabel
  // Last modified 12/7/2020

  $messages = json_decode(file_get_contents($userFolder . "messages.json"), true);

  //Get the proper user info
  $unread = $messages["unread"];
  $read = $messages["read"];
?>

<button class="btn1" onclick="hide('userInbox'); show('userHome')"><i class="fas fa-arrow-left"></i> Back</button><br><br>

<div id = "userInboxContent">
  <h4>Inbox</h4>
  <div id = "userUnreadMsg" class = "section">
    <h5>Unread messages</h5>
    <?php if (count($unread) == 0):?>
      <p class='alert alert-info' role='alert'>No new messages.</p>
    <?php else: ?>
      <?php foreach ($unread as $message):
        $sent = date('M j, Y \a\t h:iA', $message["sent"]);
      ?>
        <p class="author"><?= $message["from"]; ?><br>
        <span class="timestamp"><?= $sent; ?></span></p>
        <p class="messageContent"><?= $message["text"]; ?></p>
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
        <p class="author"><?= $message["from"]; ?><br>
        <span class="timestamp"><?= $sent; ?></span></p>
        <p class="messageContent"><?= $message["text"]; ?></p>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>