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
<div class = "section">
  <h4>Users</h4>
  <!-- reload button -->
  <p class="timestamp">Up-to-date as of <?=$updated; ?>. <button class="btn1" type="button" onclick="refreshAdminUsers()"><i class="fas fa-redo-alt"></i> Refresh</button></p>
  <p>Knitty Gritty has <?= $nrUsers; ?> registered user<?php if ($nrUsers == 0):?>s.<?php elseif ($nrUsers == 1):?>:<?php else: ?>s:<?php endif; ?>
  </p>

  <?php if ($nrUsers > 0): ?>
    <table>
      <tr>
        <th>Username</td>
        <th>User since</th>
        <th>Role</th>
        <th>No. patterns</th>
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
          <td><button class = "btn1" onclick="messageUser('<?= $uname; ?>')">Send message</button></td>
        <?php else: ?>
          <td>This is you!</td>
        <?php endif; ?>
      </tr>
      <?php endforeach; ?>
    </table>
  <?php endif;?>
</div>