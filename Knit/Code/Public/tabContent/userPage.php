<h3 class="underline">My Account</h3>

<div id = "userHome">
    <h4><?= $username; ?></h4>
    <p>This is the normal user page. Anticipated functions:</p>
    <ul>
        <li><a onclick="openProfile('<?=$username; ?>', 'userFunction', 'userHome')">View my public profile</a></li>
        <li>Customize my public profile</li>
        <li>View and download my saved patterns</li>
    </ul>
</div>

<!-- this div will be filled by various user 'pages' -->
<div id = "userFunction"></div>

<script src="js/user.js"></script>