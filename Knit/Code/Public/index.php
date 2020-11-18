<?php
	// start the session
	session_start();
	// save loggedIn boolean and username to globals (accessible to all tabs)
	if (isset($_SESSION["username"])) {
		$loggedIn = true;
        $username = $_SESSION["username"];
        $isAdmin = $_SESSION["admin"];
	} else {
		$loggedIn = false;
	}
?>

<html>
<head>
	<title>Knitty Gritty</title>
	<link rel="icon" href="imgs/icon.png" type="image/icon type">
	<!-- stylesheets -->
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="css/forum.css">
	<link rel="stylesheet" href="css/slideshow.css">
	<link rel="stylesheet" href="css/pattern.css">
	
	<!-- bootstrap stylesheets -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<!-- jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

<!-- LOGIN BAR -->
<div id="LoginBar" class="container-fluid">
	<!-- This element contains alerts about login status -- if logged in, lets a visitor know what they're logged in as and lets them log out. Displays a confirmation message when they log out.-->
	<span id="loggedIn">
		<?php if ($loggedIn): ?>
			You are logged in as <?= $username; ?>. <a onclick = "logOut()">Log Out</a>
		<?php else: ?>
			You are not logged in.
		<?php endif; ?>
	</span>
</div>

<div class="tab">
<nav class="navbar navbar-expand-lg">
  <a class="navbar-brand" href="#">Knitty Gritty <img src="imgs/logo.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav mr-auto">
		<button class="nav-item nav-link tablinks" onclick="openTab(event, 'Welcome')">Home</button>
		<button class="nav-item nav-link tablinks" onclick="openTab(event, 'Winners')">Contest</button>
		<button class="nav-item nav-link tablinks" onclick="openTab(event, 'Vote')">Vote</button>
		<button class="nav-item nav-link tablinks" onclick="openTab(event, 'Pattern')">Pattern Maker</button>
		<button class="nav-item nav-link tablinks" onclick="openTab(event, 'Forum')">Forum</button>
    </div>
    <div class="navbar-nav ml-auto" id="loginTabs">
			<?php
			$lRTabs = ""; // login and reg tabs shown by default
			$adminTab = $userTab = "hide"; // account tabs hidden by default
			// if logged in
			if ($loggedIn) {
				// hide login and reg tabs
				$lRTabs = "hide";
				// show user tab
				$userTab = "";
				// additionally, if admin
				if ($isAdmin) {
					//show admin tab
					$adminTab = "";
				}
			}
			?>
			<button class="nav-item nav-link tablinks <?=$lRTabs; ?>" onclick="openTab(event, 'Login')">Log In</button>
			<button class="nav-item nav-link tablinks <?=$lRTabs; ?>" onclick="openTab(event, 'Register')">Sign Up</button>
			<button class="nav-item nav-link tablinks <?=$userTab; ?>" id = "userTab" onclick="openTab(event, 'User')">My Account</button>
			<button class="nav-item nav-link tablinks <?=$adminTab; ?>" id = "adminTab" onclick="openTab(event, 'Admin')">Manage Site</button>
	</div>
  </div>
</nav>
</div>

<!-- HOME TAB CONTENT -->
<div id="Welcome" class="tabcontent container-fluid h-100" style="background-image: url('imgs/bg.jpg'); background-size: cover">
	<div class="row justify-content-center">
		<div class="col col-xs-12 col-md-8">
			<h1>Knitty Gritty</h1>
			<p class="slogan">Sew it seams you've gotten to the knitty gritty.</p>
			<p>Knitty Gritty is an interactive site for knitters. Visitors can view patterns and forum posts and vote in a “best of the week” competition featuring user submitted knit patterns. Registered users, in addition to these features, can submit patterns to the “best of the week” competition, create and save grid visualizations of patterns, customize a public profile, and contribute posts and responses to the forum.</p>
		</div>
	</div>
</div>

<!-- OTHER TAB CONTENT -->
<?php include "tabContent/winners.php"; ?>
<?php include "tabContent/vote.php"; ?>
<?php include "tabContent/pattern.php"; ?>
<?php include "tabContent/forum.php"; ?>
<?php include "tabContent/login.php"; ?>
<?php include "tabContent/register.php"; ?>

<!-- ACCOUNT TAB CONTENT: "Manage site" => Admin and "My account" => (normal) User-->
<div id = "User" class = "tabcontent">
	<?php 
		// Only include this page if visitor is logged in
		if ($loggedIn) {
			include "tabContent/userPage.php"; 
		}
	?>
</div>

<div id = "Admin" class = "tabcontent">
	<?php
		// Only include this page if visitor is logged in as admin
		if ($loggedIn && $isAdmin) {
			include "tabContent/adminPage.php"; 
		}
	?>
</div>

<!--<div class="footer">
	<p>© 2020, Intarsia Inc.</p>
</div>-->

<script src="js/tabs.js"></script>
<script src="js/showHide.js"></script>
<script src="js/logout.js"></script>
<script src="https://kit.fontawesome.com/4cb3e5d9fa.js" crossorigin="anonymous"></script>

</body>
</html>