<!-- the built-in "user manual"
@author mostly Isabel + Alexis on style -->

<button class = 'close' onclick = 'hide("Help")'><i class="fa fa-times"></i></button>

<h2>Help</h2>

<div id = "helpHome" class="refresh">
  <p><a onclick = "hide('helpHome'); show('helpManual')"><button class="btn1">How do I use this site?</button></a>
  <a onclick = "hide('helpHome'); show('helpAdmin')"><button class="btn1">I want to message the admin.</button></a></p>
</div>

<div id = "helpAdmin" class="refresh">
  <img src="imgs/quizzes/backbutton.jpg" alt="back button" class="backBtnImg" onclick="hide('helpAdmin'); show('helpHome')"><br><br>
  
  <form>
    <textarea id = "msgAdminHelp" placeholder = "Write your message to site admin"></textarea><br>
    <button type = "button" class = "btn1" onclick = "messageToAdmin('msgAdminHelp', 'msgAdminHelpFB' <?php if ($loggedIn) { echo ", '$username'"; } ?>)">Send</button>
    <span id = "msgAdminHelpFB"></span>
  </form>
</div>

<div id = "helpManual" class="refresh">
  <img src="imgs/quizzes/backbutton.jpg" alt="back button" class="backBtnImg" onclick="hide('helpManual'); show('helpHome')"><br><br>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Blandit massa enim nec dui nunc mattis enim. Nec ultrices dui sapien eget mi proin sed. Ac tortor dignissim convallis aenean et tortor at. Sit amet tellus cras adipiscing enim eu turpis egestas. Est ante in nibh mauris cursus mattis molestie a. Dictum non consectetur a erat. Nunc eget lorem dolor sed viverra. Leo vel fringilla est ullamcorper eget nulla facilisi etiam. Diam ut venenatis tellus in metus vulputate eu scelerisque. Amet risus nullam eget felis eget nunc lobortis mattis. Lectus sit amet est placerat in egestas erat.</p></div>