<?php
/* This is the contents of the trivia quiz
@author Bethany + styling by Alexis
Last modified 12/16/2020 */
?>

<!-- below a list of ten questions/answers -->
<div class="quizContainer">
  <!-- quiz title -->
  <h4>Take this quiz to test your knitting trivia!</h4>
  <!-- q1 -->
  <h5 class="quiz-question">How long has knitting been around?</h5>
  <ul data-quiz-question="1">
    <li class="quiz-answer" data-quiz-answer="a">No one knows</li>
    <li class="quiz-answer" data-quiz-answer="b">Since the 1600s</li>
    <li class="quiz-answer" data-quiz-answer="c">Since the 1400s</li>
    <li class="quiz-answer" data-quiz-answer="d">Since 500 BC</li>
  </ul>
  <!-- q2 -->
  <h5 class="quiz-question">Where were the earliest known samples of fabrics and yarns found?</h5>
  <ul data-quiz-question="2">
    <li class="quiz-answer" data-quiz-answer="a">Egypt</li>
    <li class="quiz-answer" data-quiz-answer="b">Switzerland</li>
    <li class="quiz-answer" data-quiz-answer="c">China</li>
    <li class="quiz-answer" data-quiz-answer="d">Brazil</li>
  </ul>
  <!-- q3 -->
  <h5 class="quiz-question">Approximately how old are the earliest known samples of fabrics and yarns?</h5>
  <ul data-quiz-question="3">
    <li class="quiz-answer" data-quiz-answer="a">1,000 years old</li>
    <li class="quiz-answer" data-quiz-answer="b">2,000 years old</li>
    <li class="quiz-answer" data-quiz-answer="c">5,000 years old</li>
    <li class="quiz-answer" data-quiz-answer="d">7,000 years old</li>
  </ul>
  <!-- q4 -->
  <h5 class="quiz-question">How many calories could you do burn after knitting for a half hour?</h5>
  <ul data-quiz-question="4">
    <li class="quiz-answer" data-quiz-answer="a">30</li>
    <li class="quiz-answer" data-quiz-answer="b">40</li>
    <li class="quiz-answer" data-quiz-answer="c">50</li>
    <li class="quiz-answer" data-quiz-answer="d">60</li>
  </ul>
  <!-- q5 -->
  <h5 class="quiz-question">What is David Babcock's Guinness World Record?</h5>
  <ul data-quiz-question="5">
    <li class="quiz-answer" data-quiz-answer="a">Creating the longest ball of yarn in the world</li>
    <li class="quiz-answer" data-quiz-answer="b">Knitting 18 sweaters while riding a unicycle in under 8 hours</li>
    <li class="quiz-answer" data-quiz-answer="c">Knitting the largest blanket in the world</li>
    <li class="quiz-answer" data-quiz-answer="d">Knitting a 12 foot long scarf while running a marathon in under 6 hours</li>
  </ul>
  <!-- q6 -->
  <h5 class="quiz-question">When did the word "knitting" first appear in the English language?</h5>
  <ul data-quiz-question="6">
    <li class="quiz-answer" data-quiz-answer="a">1400s</li>
    <li class="quiz-answer" data-quiz-answer="b">1300s</li>
    <li class="quiz-answer" data-quiz-answer="c">1200s</li>
    <li class="quiz-answer" data-quiz-answer="d">1100s</li>
  </ul>
  <!-- q7 -->
  <h5 class="quiz-question">In 2012 the record for the most people knitting simultaneously was broken. How many people were knitting?</h5>
  <ul data-quiz-question="7">
    <li class="quiz-answer" data-quiz-answer="a">3,083</li>
    <li class="quiz-answer" data-quiz-answer="b">4,178</li>
    <li class="quiz-answer" data-quiz-answer="c">6,237</li>
    <li class="quiz-answer" data-quiz-answer="d">7,298</li>
  </ul>
  <!-- q8 -->
  <h5 class="quiz-question">Between 2002 and 2004, the number of women knitters in the U.S. ages 25–35 increased nearly _%.</h5>
  <ul data-quiz-question="8">
    <li class="quiz-answer" data-quiz-answer="a">250%</li>
    <li class="quiz-answer" data-quiz-answer="b">200%</li>
    <li class="quiz-answer" data-quiz-answer="c">150%</li>
    <li class="quiz-answer" data-quiz-answer="d">100%</li>
  </ul>
  <!-- q9 -->
  <h5 class="quiz-question">When is World Wide Knit in Public Day?</h5>
  <ul data-quiz-question="9">
    <li class="quiz-answer" data-quiz-answer="a">The first week of October</li>
    <li class="quiz-answer" data-quiz-answer="b">The second week of April</li>
    <li class="quiz-answer" data-quiz-answer="c">The third week of April</li>
    <li class="quiz-answer" data-quiz-answer="d">The second week of June</li>
  </ul>
  <!-- q10 -->
  <h5 class="quiz-question">Who started World Wide Knit in Public Day?</h5>
  <ul data-quiz-question="10">
    <li class="quiz-answer" data-quiz-answer="a">Jess Davis</li>
    <li class="quiz-answer" data-quiz-answer="b">Danielle Landes</li>
    <li class="quiz-answer" data-quiz-answer="c">Michael Usoro</li>
    <li class="quiz-answer" data-quiz-answer="d">Mary Throndsen</li>
  </ul>
<!-- display result -->
  <div class="quiz-result"></div>

</div>


<script src="js/triviaQuiz.js"></script>