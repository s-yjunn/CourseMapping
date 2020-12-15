<!-- the built-in "user manual"
@author mostly Isabel + Alexis on style -->

<button class = 'close' onclick = 'hide("Help")'><i class="fa fa-times"></i></button>

<h2>Help</h2>

<div id = "helpHome">
  <p><a onclick = "hide('helpHome'); show('helpManual')">Directions for using this site (link)</a></p>
  <p><a onclick = "hide('helpHome'); show('helpAdmin')">Send a message to site admin (link)</a></p>
</div>

<div id = "helpAdmin">
  <button class="btn1" onclick="hide('helpAdmin'); show('helpHome')"><i class="fas fa-arrow-left"></i> Back</button><br><br>
  <form>
    <textarea id = "msgAdminHelp" placeholder = "Write your message to site admin"></textarea><br>
    <button type = "button" class = "btn1" onclick = "messageToAdmin('msgAdminHelp', 'msgAdminHelpFB' <?php if ($loggedIn) { echo ", '$username'"; } ?>)">Send</button>
    <span id = "msgAdminHelpFB"></span>
  </form>
</div>

<div id = "helpManual">
  <button class="btn1" onclick="hide('helpManual'); show('helpHome')"><i class="fas fa-arrow-left"></i> Back</button>
  <p>This will be the user manual.</p>
</div>