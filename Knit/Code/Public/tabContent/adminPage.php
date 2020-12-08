<?php 
/* This is the index of admin functionality
* @author Isabel (included adminContest page by Bethany)
* Last modified 12/6/2020
*/
?>

<div id="adminPage">

    <h3 class="underline">Manage Site</h3>

    <div id = "adminHome">
	    <h4><i class="fas fa-user-cog"></i> Admin</h4>
		
        <button class="btn1" onclick="hide('adminHome'); show('adminUsers')"><span class="btnTitle">Users</span><br><span class="btnText">Get info about your site's denizens.</span></button>
        <button class="btn1" onclick="hide('adminHome'); show('adminContest')"><span class="btnTitle">Contest</span><br><span class="btnText">Manage the pattern contest.</span></button>
    </div>

    <!-- this div contains site data (for now just a list of users) -->
    <div id = "adminUsers">
        <?php include "php/admin/adminUsers.php"; ?>
    </div>

    <!-- this div contains all the contest-related admin powers -->
    <div id = "adminContest">
        <?php include "php/admin/adminContest.php"; ?>
    </div>

    <!-- This div is filled by "php/user/profileStatic.php" whenever the admin clicks on a user's display name -->
    <div id = "adminProfile"></div>

</div>

<script src = "js/adminPage.js"></script>