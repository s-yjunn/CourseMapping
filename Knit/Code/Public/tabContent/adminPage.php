<?php 
/* This is the index of admin functionality
* @author Isabel (included contest page by Bethany)
* Last modified 12/6/2020
*/
?>

<div id="adminPage">

    <h3 class="underline">Manage Site</h3>

    <div id = "adminHome">
        <button class="btn1" onclick="hide('adminHome'); show('adminContest')"><span class="btnTitle">Contest</span><br><span class="btnText">Manage the "Featured" pattern contest.</span></button>
    </div>

    <!-- this div contains all the contest-related admin powers -->
    <div id = "adminContest">
        <?php include "php/admin/adminContest.php"; ?>
    </div>

</div>