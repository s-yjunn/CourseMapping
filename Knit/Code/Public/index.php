<?php
	// start the session
	session_start();
	// save loggedIn boolean and username to globals (accessible to all tabs)
	if (isset($_SESSION["username"])) {
		$loggedIn = true;
		$username = $_SESSION["username"];
	} else {
		$loggedIn = false;
	}
?>

<html>
<head>
	<!-- stylesheets -->
	<link rel="stylesheet" href="css/home.css">
	<link rel="stylesheet" href="css/forum.css">
	<!-- bootstrap stylesheets -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<!-- ajax jquery script-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

<div class="header">
	<!-- This element contains alerts about login status -- if logged in, lets a visitor know what they're logged in as and lets them log out. Displays a confirmation message when they log out.-->
	<span id = "loggedIn">
		<?php
			if ($loggedIn) {
				echo "You are logged in as $username. <a onclick = 'logOut()'>Log out</a>";
			}
		?>
	</span>
	<h2 class="title">Knitty Gritty</h2>
	<p class="slogan">Sew it seams you've gotten to the Knitty Gritty.</p>
</div>

<div id="tab">
	<button class="tablinks" onclick="openTab(event, 'Welcome')">Home</button>
	<button class="tablinks" onclick="openTab(event, 'Winners')">This Week's Winners</button>
	<button class="tablinks" onclick="openTab(event, 'Vote')">Vote</button>
	<button class="tablinks" onclick="openTab(event, 'Pattern')">Pattern Maker</button>
	<button class="tablinks" onclick="openTab(event, 'Forum')">Forum</button>
	<button class="tablinks" onclick="openTab(event, 'Login')">Log In</button>
	<button class="tablinks" onclick="openTab(event, 'Register')">Sign Up</button>

	<?php
	// deciding whether to show the account tabs
	$adminTab = $userTab = "hide"; // hidden by default
	// if logged in
	if ($loggedIn) {
		// if logged in as admin
		if ($username === "admin") {
			// show admin tab button
			$adminTab = "";
		// if logged in as normal user
		} else {
			// show user tab button
			$userTab = "";
		}
	}
	?>

	<button class="tablinks account <?=$adminTab; ?>" id = "adminTab" onclick="openTab(event, 'Admin')">Manage site</button>
	<button class="tablinks account <?=$userTab; ?>" id = "userTab" onclick="openTab(event, 'User')">My account</button>
</div>

<!-- "Home" tab's content below-->
<div id="Welcome" class="tabcontent">
	<div class="card">
		<h3>Welcome to Knitty Gritty!</h3>
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

<!--Account tabs: "Manage site" => Admin and "My account" => (normal) User-->
<div id = "Admin" class = "tabcontent card">
	<?php
		// Only include this page if visitor is logged in as admin
		if ($loggedIn && $username === "admin") {
			include "tabContent/adminPage.php"; 
		}
	?>
</div>

<div id = "User" class = "tabcontent card">
	<?php 
		// Only include this page if user is logged in as a normal user
		if ($loggedIn && $username != "admin") {
			include "tabContent/userPage.php"; 
		}
	?>
</div>

<div class="footer">
	<p>© 2020, Intarsia Inc.</p>
</div>

<script src="js/tabs.js"></script>
<script src="js/showHide.js"></script>
<script src="js/logout.js"></script>
<!-- fontawesome script -->
<script src="https://kit.fontawesome.com/4cb3e5d9fa.js" crossorigin="anonymous"></script>

</body>
</html>