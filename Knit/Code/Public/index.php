<html>
<head>
  <link rel="stylesheet" href="css/home.css">
</head>
<body>

<div class="header">
	<h2 class="title">Knitty Gritty</h2>
	<p class="slogan">Sew it seems you've gotten to the Knitty Gritty</p>
</div>

<!-- Please feel free to change the function/tab names I just needed a place holder :) -->
<div class="tab">
  <button class="tablinks" onclick="openTab(event, 'Welcome')" id="defaultOpen">Home</button>
  <button class="tablinks" onclick="openTab(event, 'Winners')">This Week's Winners!</button>
  <button class="tablinks" onclick="openTab(event, 'Vote')">Vote!</button>
  <button class="tablinks" onclick="openTab(event, 'Pattern')">Pattern Maker</button>
  <button class="tablinks" onclick="openTab(event, 'Forum')">Forum</button>
  <button class="tablinks" onclick="openTab(event, 'Login')">Log In</button>
  <button class="tablinks" onclick="openTab(event, 'Register')">Sign Up</button>
</div>

<div id="Welcome" class="tabcontent">
	<div class="card">
	  <h3>Welcome to the Knitty Gritty!</h3>
	  <p>This is an interactive site for knitters. Visitors can view patterns and forum posts
	       and possibly vote for the “best of the week”. Registered users can additionally
	        submit patterns to the “best of the week” competition, make and save grid
	         visualizations of patterns, customize a public profile, and post in the forum.</p>
	</div>
</div>

<div id="Winners" class="tabcontent">
	<div class="card">
	  <h3>Here are your "Best of Week" Winners!</h3>
	  <p>*slideshow*</p> 
	</div>
</div>

<div id="Vote" class="tabcontent">
	<div class="card">
	  <h3>Vote for Your Favorite Design or Submit Your Own!</h3>
	  <p>*slideshow*</p> 
	</div>
</div>

<div id="Pattern" class="tabcontent">
	<div class="card">
	  <h3>Pattern Maker</h3>
	  <p>Only members can create patters! Log in or sign up to become a member!</p> 
	</div>
</div>

<div id="Forum" class="tabcontent">
	<div class="card">
	  <h3>Forum</h3>
	  <p>___________________________</p> 
	  <p>___________________________</p> 
	  <p>___________________________</p> 
	  <p>___________________________</p> 
	  <p>___________________________</p> 
	</div>
</div>

<div id="Login" class="tabcontent">
	<div class="card">
	  <h3>Log In</h3>
	  <div>
	      <label for="uname"><b>Username</b></label> <br>
	      <input type="text" placeholder="Enter Username" name="uname" required><br>

	      <label for="psw"><b>Password</b></label><br>
	      <input type="password" placeholder="Enter Password" name="psw" required>
        
	      <button type="submit">Login</button>
	    </div>
	</div>
</div>

<div id="Register" class="tabcontent">
	<div class="card">
		<h3>Sign Up</h3>
		<div>
			<label for="uname"><b>Username</b></label> <br>
			<input type="text" placeholder="Enter Username" name="uname" required><br>

			<label for="psw"><b>Password</b></label><br>
			<input type="password" placeholder="Enter Password" name="psw" required><br>
			<label for="confPsw"><b>Confirm Password</b></label><br>
			<input type="password" placeholder="Enter Password" name="confPsw" required>

			<button type="submit">Login</button>
		</div>
	</div>
</div>

<div class="footer">
	<p>© 2020, Intarsia Inc.</p>
</div>

<script src = "js/tabs.js"></script>
</body>
</html>