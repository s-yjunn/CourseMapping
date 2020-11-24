<?php

	// insert include("src/login.php"); when it's made

	// *************************************************************************** //
	// Skeleton for logging in/out:
	
	//SASHAS ATTEMPT FOR REGISTER CODE BELOW
	include("src/register.php");
	session_start(); // php SESSION to keep user logged in (expires after certain amount of time)

	// if registering:
	if(isset($_POST["uname_r"]) && isset($_POST["upass_r"])) {
		if(register($_POST["uname_r"], $_POST["upass_r"])) {
			echo('
				<div class="notification is-success floating" id="good-login">
					<button class="delete"></button>
					Successful registration!
				</div>
        	');	
		}
	}
    
    // if logging in:
    if(isset($_POST["uname"]) && isset($_POST["upass"])) { // POST from self, form at bottom of page
        if(handle_login($_POST["uname"], $_POST["upass"])) { // handle_login() should take two parameters (user,pass) and return true or false
            
            // success
            $_SESSION["username"] = $_POST["uname"];
            $_SESSION["loggedIn"] = 1;

			// create draggable notification for success
            echo('
            <div class="notification is-success floating" id="good-login">
                <button class="delete"></button>
                Successful login. Welcome back!
            </div>
        ');

        } else {

			// failure
			// create draggable notification for failure
            echo('
                <div class="notification is-danger floating" id="bad-login">
                    <button class="delete"></button>
                    Bad login. Please try again.
                </div>
            ');

        }
    }

    // if logging out:
    if(isset($_POST["logout"])) { // POST from self

        // get rid of all SESSION variables
        $_SESSION = array();
        session_destroy();

	}
	
	// *************************************************************************** //

?>
	<nav class="navbar is-white" role="navigation" aria-label="main navigation">
		<div class="navbar-brand">
			<div class="navbar-item"> <a href='index.php'><span class='twenty-title'>2Twenty</span></a> </div>
			<a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"> <span aria-hidden="true"></span> <span aria-hidden="true"></span> <span aria-hidden="true"></span> </a>
		</div>
		<div class="navbar-menu">
			<div class="navbar-end"> <a class="navbar-item" href="index.php">Home</a> <a class="navbar-item">About</a>
				<div class="navbar-item">
					<?php
                    if(!isset($_SESSION["loggedIn"])) {
                        echo('
                        <div class="buttons">
                            <a class="button is-primary is-rounded is-outlined" id="register"><b>Sign up</b></a>
                            <a class="button is-danger is-rounded is-outlined" id="login">Log in</a>
                        </div>
                        ');
                    } else {
                        echo('
                        <div class="navbar-item">Welcome back, <strong class="ml-1">'.$_SESSION["username"].'</strong>!</div>
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

	<div class="modal" id="register-modal">
		<div class="modal-background"></div>
		<div class="modal-content">
			<header class="modal-card-head">
				<p class="modal-card-title">Register</p>
			</header>
			<section class="modal-card-body">
				<form class="field" method="POST" autocomplete="off"> <span id="register-error" class="has-text-danger"></span>
					<input class="input is-rounded mb-4 mt-4" type="text" name="uname_r" placeholder="Username">
					<input class="input is-rounded mb-4 mt-4" type="password" name="upass_r" placeholder="Password">
					<input class="button is-success mt-4" type="submit" value="Register" id="register-submit"> </form>
			</section>
		</div>
		<button class="modal-close is-large" aria-label="close"></button>
	</div>



	<div class="modal" id="login-modal">
		<div class="modal-background"></div>
		<div class="modal-content">
			<header class="modal-card-head">
				<p class="modal-card-title">Log In</p>
			</header>
			<section class="modal-card-body">
				<form class="field" method="POST" autocomplete="off"> <span id="login-error" class="has-text-danger"></span>
					<input class="input is-rounded mb-4 mt-4" type="text" name="uname" placeholder="Username">
					<input class="input is-rounded mb-4 mt-4" type="password" name="upass" placeholder="Password">
					<input class="button is-success mt-4" type="submit" value="Log In" id="login-submit"> </form>
			</section>
		</div>
		<button class="modal-close is-large" aria-label="close"></button>
	</div>


