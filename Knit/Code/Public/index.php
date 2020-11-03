<html>
<head>
  <link rel="stylesheet" href="css/home.css">
</head>
<body>

<div class="header">
	<h2 class="title">Knitty Gritty</h2>
	<p class="slogan">Sew it seams you've gotten to the Knitty Gritty</p>
</div>

<div class="tab">
  <button class="tablinks" onclick="openTab(event, 'Welcome')" id="defaultOpen">Home</button>
  <button class="tablinks" onclick="openTab(event, 'Winners')">This Week's Winners!</button>
  <button class="tablinks" onclick="openTab(event, 'Vote')">Vote!</button>
  <button class="tablinks" onclick="openTab(event, 'Pattern')">Pattern Maker</button>
  <button class="tablinks" onclick="openTab(event, 'Forum')">Forum</button>
  <button class="tablinks" onclick="openTab(event, 'Login')">Log In</button>
  <button class="tablinks" onclick="openTab(event, 'Register')">Sign Up</button>
</div>

<!-- "Home" tab's content below / I feel like it's ok for this to stay in the main file since it's descriptive and not going to get complex but feel free to move-->
<div id="Welcome" class="tabcontent">
	<div class="card">
	  <h3>Welcome to the Knitty Gritty!</h3>
	  <p>This is an interactive site for knitters. Visitors can view patterns and forum posts and possibly vote for the “best of the week”. Registered users can additionally submit patterns to the “best of the week” competition, make and save grid visualizations of patterns, customize a public profile, and post in the forum.</p>
	</div>
</div>

<!-- Other tabs' content imported below-->
<?php include "tabContent/winners.php"; ?>
<?php include "tabContent/vote.php"; ?>
<?php include "tabContent/pattern.php"; ?>
<?php include "tabContent/forum.php"; ?>
<?php include "tabContent/login.php"; ?>
<?php include "tabContent/register.php"; ?>

<div class="footer">
	<p>© 2020, Intarsia Inc.</p>
</div>

<script src="js/tabs.js"></script>
</body>
</html>