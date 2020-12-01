<?php
  // This file (imported into the user page) allows a user to see their saved patterns.
  // @author Isabel
  // Last modified 11/30/2020

  $privatePa = $userData["private"];
  $publicPa = $userData["public"];
  $userFolder = "../Private/imgs/" . $username . "/"
?>
<button class="btn1" onclick="hide('userPatterns'); show('userHome')"><i class="fas fa-arrow-left"></i> Back</button><br><br>
<p id = 'uPaDiv'>Here are your saved patterns. Click on a pattern to see more options (download, change privacy settings).</p>
<?php foreach($publicPa as $id => $pattern): ?>
  <a onclick = "show('uPublic<?= $id; ?>')"><img class='uPa' src="<?= $userFolder . $pattern; ?>" alt = "Pattern by you"></a>
  <div class = 'dark' id = 'uPublic<?= $id; ?>'>
    <div class = "float">
      <button class = "btn1" id = 'close' onclick = 'hide("uPublic<?= $id; ?>")'><i class="fa fa-times"></i></button><br>
      <h5> <?= $pattern; ?></h5>
      <p>Public</p>
      <img class = "uPaM" src = '<?= $userFolder . $pattern; ?>' max-width = 100%><br>
      <a href = '<?= $userFolder . $pattern; ?>' download>Download</a>
    </div>
  </div>
<?php endforeach; ?> 
<?php foreach($privatePa as $id => $pattern): ?>
  <a onclick = "show('uPrivate<?= $id; ?>')"><img class='uPa' src="<?= $userFolder . $pattern; ?>" alt = "Pattern by you"></a>
  <div class = 'dark' id = 'uPrivate<?= $id; ?>'>
    <div class = "float">
      <button class = "btn1" id = 'close' onclick = 'hide("uPrivate<?= $id; ?>")'><i class="fa fa-times"></i></button><br>
      <h5> <?= $pattern; ?></h5>
      <p>Private</p>
      <img class = "uPaM" src = '<?= $userFolder . $pattern; ?>' max-width = 100% ><br>
      <a href = '<?= $userFolder . $pattern; ?>' download>Download</a>
    </div>
  </div>
<?php endforeach; ?>