<html>
<head>
  <link rel = "stylesheet" href = "css/home.css">
</head>
<body>



<h2 style="text-align: center;">The Knitty Gritty</h2>
<p style="text-align: center;">Sew it seems you've gotten to the Knitty Gritty</p>

<!-- Please feel free to change the function/tab names I just needed a place holder :) -->
<div class="tab">
  <button class="tablinks" onclick="openTab(event, 'Home')" id="defaultOpen">Home</button>
  <button class="tablinks" onclick="openTab(event, 'Winners')">This Week's Winners!</button>
  <button class="tablinks" onclick="openTab(event, 'Vote')">Vote!</button>
  <button class="tablinks" onclick="openTab(event, 'Pattern')">Pattern Maker</button>
  <button class="tablinks" onclick="openTab(event, 'Forum')">Forum</button>
  <button class="tablinks" onclick="openTab(event, 'Login')">Log In</button>
  <button class="tablinks" onclick="openTab(event, 'Register')">Sign Up</button>
</div>

<div id="Welcome" class="tabcontent">
  <h3>Welcome to the Knitty Gritty!</h3>
  <p>This is an interactive site for knitters. Visitors can view patterns and forum posts
       and possibly vote for the “best of the week”. Registered users can additionally
        submit patterns to the “best of the week” competition, make and save grid
         visualizations of patterns, customize a public profile, and post in the forum.</p>
</div>

<div id="Winners" class="tabcontent">
  <h3>Here are your "Best of Week" Winners!</h3>
  <p>*slideshow*</p> 
</div>

<div id="Vote" class="tabcontent">
  <h3>Vote for Your Favorite Design or Submit Your Own!</h3>
  <p>*slideshow*</p> 
</div>

<div id="Pattern" class="tabcontent">
  <h3>Pattern Maker</h3>
  <p>Only members can create patters! Log in or sign up to become a member!</p> 
</div>

<div id="Forum" class="tabcontent">
  <h3>Forum</h3>
  <p>___________________________</p> 
  <p>___________________________</p> 
  <p>___________________________</p> 
  <p>___________________________</p> 
  <p>___________________________</p> 
</div>

<div id="Login" class="tabcontent">
  <h3>Log In</h3>
  <div>
      <label for="uname"><b>Username</b></label> <br>
      <input type="text" placeholder="Enter Username" name="uname" required><br>

      <label for="psw"><b>Password</b></label><br>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button type="submit">Login</button>
    </div>
</div>

<div id="Register" class="tabcontent">
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

<p style="text-align: center;">© 2020, Intarsia Inc.</p>



  <script src = "js/tabs.js"></script>
</body>
</html>