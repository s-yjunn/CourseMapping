<?php
  // This file (imported into the user page) allows a user to see their saved patterns.
  // @author Isabel
  // Last modified 12/2/2020

  // getting the patterns' data
  $patterns = $userData["patterns"];
  // path to image files
  $userFolder = "../Private/imgs/" . $username . "/"
?>
<button class="btn1" onclick="hide('userPatterns'); show('userHome')"><i class="fas fa-arrow-left"></i> Back</button><br><br>
<?php if (count($patterns) == 0): ?>
  <p>You don't have any saved patterns yet. Go to the "Pattern Maker" tab to add some!</p>
<?php else: ?>
  <p id = 'uPaDiv'>Here are your saved patterns. Click on a pattern to see more options (download, view privacy level).</p>
  <?php foreach($patterns as $index => $pattern): 
    $imgFile = $pattern["image"];
    if ($pattern["public"]) {
      $pubPr = "Public";
    } else {
      $pubPr = "Private";
    }
  ?>
    <a onclick = "show('managePattern<?= $index; ?>')"><img class='uPa' src="<?= $userFolder . $imgFile; ?>" alt = "Pattern by you"></a>
    <div class = 'dark' id = 'managePattern<?= $index; ?>'>
      <div class = "float">
        <button class = "btn1" id = 'close' onclick = 'hide("managePattern<?= $index; ?>")'><i class="fa fa-times"></i></button><br>
        <h5> <?= $imgFile; ?></h5>
        <p><?= $pubPr; ?></p>
        <img class = "uPaM" src = '<?= $userFolder . $imgFile; ?>' max-width = 100%><br>
        <a href = '<?= $userFolder . $imgFile; ?>' download>Download</a>
      </div>
    </div>
  <?php endforeach; ?>
<?php endif; ?>