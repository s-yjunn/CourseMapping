<?php
  /* This page shows an administrator overview information about the site's users
  * @author Isabel
  * Last modified 12/7/2020
  */ 

  // format time of users data fetched by userPage.php code
  $updated = date('M j, Y \a\t h:iA \U\T\C', $uDataTime);

  $nrUsers = count($usersData);
?>

<button class="btn1" onclick="hide('adminUsers'); show('adminHome')"><i class="fas fa-arrow-left"></i> Back</button>
<div class = "section refresh" id = "adminUserList">
  <h4>Users <button class="btn1 btnIcon float-right" type="button" onclick="refreshAdminUsers()"><i class="fas fa-redo-alt fa-xs"></i></button></h4>
  <!-- reload button -->
  <p class="timestamp">Up-to-date as of <?=$updated; ?>.</p>
  <!-- any updates go here -->
  <span id = "adminUsersDiv"></span>
  <p>Knitty Gritty has <?= $nrUsers; ?> registered user<?php if ($nrUsers == 0):?>s.<?php elseif ($nrUsers == 1):?>:<?php else: ?>s:<?php endif; ?>
  </p>

  <?php if ($nrUsers > 0): ?>
	  <div class="tableDiv">
    <table class="table">
      <tr>
        <th>Username</td>
        <th>User since</th>
        <th>Role</th>
        <th>No. patterns</th>
        <th></th> <!-- all the empty guys are just here to fill out the borders -->
        <th></th>
      <?php foreach ($usersData as $uname => $info): 
        $registered =  date('M j, Y', $info["registered"]);
        if ($info["admin"]) {
          $role = "Administrator";
        } else {
          $role = "Standard user";
        }
        // is this user the admin reading this?
        $self = ($uname === $username);
      ?>
      <tr>
        <td><?= $uname; ?></td>
        <td><?= $registered; ?></td>
        <td><?= $role; ?></td>
        <td><?= count($info["patterns"]); ?></td>
        <?php if (!$self): ?>
          <td><button class = "btn1" onclick="openProfile('<?= $uname; ?>', 'adminProfile', 'adminUsers', '')">View profile</button></td>
          <td><button class = "btn1" onclick="showAdminCompose('<?= $uname; ?>', '<?= $username; ?>')">Send message</button></td>
        <?php else: ?>
          <td><p class='alert alert-info' role='alert'>This is you!</p></td>
          <td></td>
        <?php endif; ?>
      </tr>
      <?php endforeach; ?>
    </table>
</div>
  <?php endif;?>
</div>

<div id = "adminCompose" class = "dark">
  <div class = "float">
    <textarea class = "messageCompose" id = "msgToUser"></textarea><br><br>
    <button class = "btn1" id = "msgToUserBtn">Send</button>
    <button class = "btn1" onclick = "cancelAdminCompose()">Cancel</button><br><br>
    <span id = "msgToUserFeedback"></span>
  </div>
</div>