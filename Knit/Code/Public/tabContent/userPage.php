<?php
    /* This file creates the contents of the "my account" tab (minus included content)
    * @author Isabel
    */ 

    // Get user's info
    $usersData = json_decode(file_get_contents("../Private/users.json"), true);
    $userData = $usersData[$username];
    // path to image files
    $userFolder = "../Private/" . $username . "/"
?>

<h3 class="underline">My Account</h3>

<div id = "userHome">
    <h4><i class="fas fa-user"></i> <?= $username; ?></h4>
    <button class="btn1" onclick="hide('userHome'); show('userProfile')"><span class="btnTitle">My Profile</span><br><span class="btnText">View and customize my public profile.</span></button>
    <button class="btn1" onclick="hide('userHome'); show('userPatterns')"><span class="btnTitle">My Patterns</span><br><span class="btnText">View and download my saved patterns.</span></button>
    </ul>
</div>

<!-- this div contains the profile functions -->
<div id = "userProfile">
    <?php include "php/user/userProfile.php"; ?>
</div>

<!-- this div contains the pattern management functions -->
<div id = "userPatterns">
    <?php include "php/user/userPatterns.php"; ?>
</div>