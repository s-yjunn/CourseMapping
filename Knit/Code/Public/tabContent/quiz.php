<?php 
/* This is the contents of the quizzes tab
@author Bethany
Last modified 12/16/2020 */
?>

<div id="Quizzes" class="tabcontent">
	
  <div id="QuizHome">
    <h3 class="underline">Quizzes</h3>
    <!-- holds all quizzes -->
    <div id="all" class="refresh">
      <p id="one" class="quizThumbnail">Take this quiz to test your knitting trivia!</p>
      <br><br>
    </div>
  </div>
  <!-- back button -->
  <img src="imgs/quizzes/backbutton.jpg" alt="back button" id="back" class="backBtnImg"><br><br>
  <!-- holds all quizzes -->
  <div class="quizContent" id="quiz">
    <?php include "php/quizzes/trivia.php" ?>
  </div>
  
</div>

<script src="js/quiz.js"></script>