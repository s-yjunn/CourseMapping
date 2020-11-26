<!-- <div id = "login" class="modal">
<span onclick="document.getElementById('Login').style.display='none'"
class="close" title="Close Modal">&times;</span> -->
<!-- <form class = "modal-content animate" action="php/login.php" method="post">
    <h2>Login</h2>
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
    <button type="submit" class = "loginBtn">Login</button>
</form> -->
<!-- </div>
</div> -->

<div id="login" class="modal">
<form class = "modal-content animate" action="php/login.php" method="post">
    <div class = "imgcontainer">
    <span onclick="document.getElementById('login').style.display='none'"
class="close" title="Close Modal">&times;</span>
<h2 style = "float:center"> Login</h2>
</div>
    <div class="container">
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>
    <button type="submit" class ="loginBtn">Login</button>
    </div>
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('login').style.display='none'" class="cancelbtn">Cancel</button>
      </div>
    </form>
    </div>

