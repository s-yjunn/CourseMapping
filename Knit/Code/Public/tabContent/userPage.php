<?php
    // Get user's info
    $usersData = json_decode(file_get_contents("../Private/data/users.json"), true);
    $userData = $usersData[$username];
?>

<h3 class="underline">My Account</h3>

<div id = "userHome">
    <h4><?= $username; ?></h4>
    <p>This is the normal user page. Anticipated functions:</p>
    <ul>
        <li><a onclick="hide('userHome'); show('userProfile')">View and customize my public profile</a></li>
        <li><a onclick="hide('userHome'); show('userPatterns')">View and download my saved patterns</a></li>
    </ul>
</div>

<!-- this div contains the profile functions -->
<div id = "userProfile">
    <?php include "php/user/profileEdit.php"; ?>
</div>

<!-- this div contains the pattern management functions -->
<div id = "userPatterns">
    <?php include "php/user/patterns.php"; ?>
</div>