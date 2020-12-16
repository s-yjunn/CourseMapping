<?php
    /* This file creates the contents of the "my account" tab (minus included content)
    * @author Isabel + styling by Alexis
    */ 

    // Get user's info (used in admin stats page as well)
    $uDataTime = time(); // timestamp for admin page
    $usersData = json_decode(file_get_contents("../Private/users.json"), true);
    $userData = $usersData[$username];
    // path to image files
    $userFolder = "../Private/" . $username . "/"
?>

<h3 class="underline">My Account</h3>

<div id = "userHome">
    <h4><i class="fas fa-user"></i> <?= $username; ?></h4>
    <button class="btn1" onclick="openUserInbox('<?= $username; ?>')"><span class="btnTitle">Inbox</span><br><span class="btnText">View messages from site admin.</span></button>
    <button class="btn1" onclick="hide('userHome'); show('userProfile')"><span class="btnTitle">Profile</span><br><span class="btnText">View and customize public profile.</span></button>
    <button class="btn1" onclick="hide('userHome'); show('userPatterns')"><span class="btnTitle">Patterns</span><br><span class="btnText">View and manage saved patterns.</span></button>
</div>

<!-- this div is filled by php/user/userInbox.php -->
<div id = "userInbox"></div>

<!-- this div contains the profile functions -->
<div id = "userProfile">
    <?php include "php/user/userProfile.php"; ?>
</div>

<!-- this div contains the pattern management functions -->
<div id = "userPatterns">
    <?php include "php/user/userPatterns.php"; ?>
</div>