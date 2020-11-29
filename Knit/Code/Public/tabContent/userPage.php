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
        <li>View and download my saved patterns</li>
    </ul>
</div>

<!-- this div will be filled by various user 'pages' -->
<div id = "userProfile">
    <?php include "php/user/profileEdit.php"; ?>
</div>