<?php
include ("src/login.php");
include ("src/user_lookup.php");
include ("src/display_items.php");
//include ("src/verify_install.php");
session_start();

// if logging in:
if (isset($_POST["uname"]) && isset($_POST["upass"]))
{
    if (handle_login($_POST["uname"], $_POST["upass"]))
    {

        // success
        $_SESSION["username"] = $_POST["uname"];
        $_SESSION["loggedIn"] = 1;

        echo ('
            <div class="notification is-success floating" id="good-login">
                <button class="delete"></button>
                Successful login. Welcome back!
            </div>
        ');

    }
    else
    {

        // failure
        echo ('
                <div class="notification is-danger floating" id="bad-login">
                    <button class="delete"></button>
                    Bad login. Please try again.
                </div>
            ');

    }
}

// if registering:
if (isset($_POST["uname_r"]) && isset($_POST["upass_r"]))
{
    if (handle_registration($_POST["uname_r"], $_POST["upass_r"]))
    {

        // success
        echo ('
            <div class="notification is-success floating" id="good-login">
                <button class="delete"></button>
                Successful registration. Thank you!
            </div>
        ');

    }
    else
    {

        // failure
        echo ('
                <div class="notification is-danger floating" id="bad-login">
                    <button class="delete"></button>
                    Bad registration. Please try again.
                </div>
            ');

    }
}

// if logging out:
if (isset($_POST["logout"]))
{

    // get rid of all SESSION variables
    $_SESSION = array();
    session_destroy();

}

?>
	<nav class="navbar is-white" role="navigation" aria-label="main navigation">
		<div class="navbar-brand">
            <?php include ("vars/cart.php"); ?>
			<a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"> <span aria-hidden="true"></span> <span aria-hidden="true"></span> <span aria-hidden="true"></span> </a>
		</div>
		<div class="navbar-menu">
			<div class="navbar-end"> <a class="navbar-item" href="index.php">Home</a> <a class="navbar-item">About</a>
                <?php if (isset($_SESSION["loggedIn"])) echo ('<a class="navbar-item" href="user.php?id=' . getUserId($_SESSION["username"]) . '">My Page</a>'); ?>
				<div class="navbar-item">
					<?php
if (!isset($_SESSION["loggedIn"]))
{
    echo ('
                        <div class="buttons">
                            <a class="button is-primary is-rounded is-outlined" id="register"><b>Sign up</b></a>
                            <a class="button is-danger is-rounded is-outlined" id="login">Log in</a>
                        </div>
                        ');
}
else
{
    echo ('
                        <div class="navbar-item">Welcome back, <strong class="ml-1">' . $_SESSION["username"] . '</strong>!</div>
                        <div class="buttons">
                            <form class="field" method="POST" action="index.php">
                                <input type="submit" name="logout" class="button is-danger is-rounded is-outlined" value="Logout">
                            </form>
                        </div>
                        ');
}
?> </div>

			</div>
		</div>
	</nav>

    <!-- Login form -->
	<div class="modal" id="login-modal">
		<div class="modal-background"></div>
		<div class="modal-content">
			<header class="modal-card-head">
				<p class="modal-card-title">Log In</p>
			</header>
			<section class="modal-card-body">
				<form class="field" method="POST" autocomplete="off">
					<input class="input is-rounded mb-4 mt-4" type="text" name="uname" placeholder="Username">
					<input class="input is-rounded mb-4 mt-4" type="password" name="upass" placeholder="Password">
					<input class="button is-danger mt-4" type="submit" value="Log In"> 
                </form>
			</section>
		</div>
		<button class="modal-close is-large" aria-label="close"></button>
	</div>
    <!-- End of Login -->

    <!-- Register form -->
    <div class="modal" id="register-modal">
		<div class="modal-background"></div>
		<div class="modal-content">
			<header class="modal-card-head">
				<p class="modal-card-title">Sign Up</p>
			</header>
			<section class="modal-card-body">
				<form class="field" method="POST" autocomplete="off">
					<input class="input is-rounded mb-4 mt-4" type="text" name="uname_r" placeholder="Username">
					<input class="input is-rounded mb-4 mt-4" type="password" name="upass_r" placeholder="Password">
					<input class="button is-primary mt-4" type="submit" value="Sign Up"> 
                </form>
			</section>
		</div>
		<button class="modal-close is-large" aria-label="close"></button>
	</div>
    <!-- End of Register -->
