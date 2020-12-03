<?php
    // Get user's info
    $usersData = json_decode(file_get_contents("../Private/data/users.json"), true);
    $userData = $usersData[$username];
?>

<h3 class="underline">My Account</h3>

<div id = "userHome">
    <h4><i class="fas fa-user"></i> <?= $username; ?></h4>
    <a onclick="hide('userHome'); show('userProfile')"><button class="btn1"><span class="btnTitle">My Profile</span><br><span class="btnText">View and customize my public profile.</span></button></a>
    <a onclick="hide('userHome'); show('userPatterns')"><button class="btn1"><span class="btnTitle">My Patterns</span><br><span class="btnText">View and download my saved patterns.</span></button></a>
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