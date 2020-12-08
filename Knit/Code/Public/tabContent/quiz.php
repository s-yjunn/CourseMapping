
<style>
/*body {
  margin: 0;
  padding: 20px;
}
.quiz {
  padding: 0 30px 20px 30px;
  max-width: 960px;
  margin: 0 auto;
}
.quiz ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
.quiz-question {
  font-weight: bold;
  display: block;
  padding: 30px 0 10px 0;
  margin: 0;
}
.quiz-answer {
  margin: 0;
  padding: 10px;
  background: #f7f7f7;
  margin-bottom: 5px;
  cursor: pointer;
}
.quiz-answer:hover {
  background: #eee;
}
.quiz-answer:before {
  content: "";
  display: inline-block;
  width: 15px;
  height: 15px;
  border: 1px solid #ccc;
  background: #fff;
  vertical-align: middle;
  margin-right: 10px;
}
.quiz-answer.active:before {
  background-color: #333;
  border-color: #333;
}
.quiz-answer.correct:before {
  background-color: green;
  border-color: green;
}
.quiz-answer.incorrect:before {
  background-color: red;
  border-color: red;
}
.quiz-answer.active.correct:before {
  outline: 2px solid green;
  outline-offset: 2px;
}
.quiz-result {
  max-width: 960px;
  margin: 0 auto;
  font-weight: bold;
  text-align: center;
  color: #fff;
  padding: 20px;
}
.quiz-result.good {
  background: green;
}
.quiz-result.mid {
  background: orange;
}
.quiz-result.bad {
  background: red;
}*/

</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#all").show();
  $("#back1").click(function(){
    $("#first").hide();
    $("#all").show();
  });
  $("#back2").click(function(){
    $("#second").hide();
    $("#all").show();
  });
  $("#back3").click(function(){
    $("#third").hide();
    $("#all").show();
  });
  $("#back4").click(function(){
    $("#fourth").hide();
    $("#all").show();
  });
  $("#one").click(function(){
    $("#all").hide();
    $("#first").show();
  });
  $("#two").click(function(){
    $("#all").hide();
    $("#second").show();
  });
  $("#three").click(function(){
    $("#all").hide();
    $("#third").show();
  });
  $("#four").click(function(){
    $("#all").hide();
    $("#fourth").show();
  });
});

</script>

<div id="Quizzes" class="tabcontent">
	
<div id="QuizHome">
<h3 class="underline">Quizzes</h3>

<div id="all">

  <p id="one" class="quizThumbnail">What type of yarn are you?</p>
  <p id="two" class="quizThumbnail">What stitch are you?</p>
  <p id="three" class="quizThumbnail">What on-screen kntting scene are you?</p>
  <p id="four" class="quizThumbnail">Take this quiz to test your knitting trivia!</p>

</div>
</div>

<div class="quiz" id="first" style="display: none;">

<img src="imgs/quizzes/backbutton.jpg" alt="back button" id="back1" class="backBtnImg">

<div class="quizContent">
  <h4>Which type of yarn are you?</h4>
  
  <h5 class="quiz-question">i'll add real questions when i find the bug</h5>
  <ul data-quiz-question="1">
    <li class="quiz-answer" data-quiz-answer="a">moses</li>
    <li class="quiz-answer" data-quiz-answer="b">supposes</li>
    <li class="quiz-answer" data-quiz-answer="c">his</li>
    <li class="quiz-answer" data-quiz-answer="d">toeses</li>
  </ul>
  
  <h5 class="quiz-question">Are you knitty?</h5>
  <ul data-quiz-question="2">
    <li class="quiz-answer" data-quiz-answer="a">are</li>
    <li class="quiz-answer" data-quiz-answer="b">roses</li>
    <li class="quiz-answer" data-quiz-answer="c">but</li>
    <li class="quiz-answer" data-quiz-answer="d">moses</li>
  </ul>
  
  <h5 class="quiz-question">Are you gritty?</h5>
  <ul data-quiz-question="3">
    <li class="quiz-answer" data-quiz-answer="a">supposes</li>
    <li class="quiz-answer" data-quiz-answer="b">erroneously</li>
    <li class="quiz-answer" data-quiz-answer="c">for</li>
    <li class="quiz-answer" data-quiz-answer="d">moses</li>
  </ul>
  
  <h5 class="quiz-question">What is your opinion of the word "intarsia"?</h5>
  <ul data-quiz-question="4">
    <li class="quiz-answer" data-quiz-answer="a">he</li>
    <li class="quiz-answer" data-quiz-answer="b">knowses</li>
    <li class="quiz-answer" data-quiz-answer="c">his</li>
    <li class="quiz-answer" data-quiz-answer="d">toeses</li>
  </ul>
  
  <h5 class="quiz-question">What is the name of the fly on the wall?</h5>
  <ul data-quiz-question="5">
    <li class="quiz-answer" data-quiz-answer="a">aren't</li>
    <li class="quiz-answer" data-quiz-answer="b">roses</li>
    <li class="quiz-answer" data-quiz-answer="c">as</li>
    <li class="quiz-answer" data-quiz-answer="d">moses</li>
  </ul>
  
  <h5 class="quiz-question">Sew it seems you gotten to the end of the quiz....yes?</h5>
  <ul data-quiz-question="6">
    <li class="quiz-answer" data-quiz-answer="a">supposes</li>
    <li class="quiz-answer" data-quiz-answer="b">his</li>
    <li class="quiz-answer" data-quiz-answer="c">toeses</li>
    <li class="quiz-answer" data-quiz-answer="d">to be</li>
  </ul>

  <div class="quiz-result"></div>

</div>
</div>

<div class="quiz" id="second" style="display: none;">

<img src="imgs/quizzes/backbutton.jpg" alt="back button" id="back2" class="backBtnImg">

<div class="quizContent">

  <h4>What stitch are you?</h4>
  
  <h5 class="quiz-question">i'll add real questions when i find the bug</h5>
  <ul data-quiz-question="1">
    <li class="quiz-answer" data-quiz-answer="a">moses</li>
    <li class="quiz-answer" data-quiz-answer="b">supposes</li>
    <li class="quiz-answer" data-quiz-answer="c">his</li>
    <li class="quiz-answer" data-quiz-answer="d">toeses</li>
  </ul>
  
  <h5 class="quiz-question">Are you knitty?</h5>
  <ul data-quiz-question="2">
    <li class="quiz-answer" data-quiz-answer="a">are</li>
    <li class="quiz-answer" data-quiz-answer="b">roses</li>
    <li class="quiz-answer" data-quiz-answer="c">but</li>
    <li class="quiz-answer" data-quiz-answer="d">moses</li>
  </ul>
  
  <h5 class="quiz-question">Are you gritty?</h5>
  <ul data-quiz-question="3">
    <li class="quiz-answer" data-quiz-answer="a">supposes</li>
    <li class="quiz-answer" data-quiz-answer="b">erroneously</li>
    <li class="quiz-answer" data-quiz-answer="c">for</li>
    <li class="quiz-answer" data-quiz-answer="d">moses</li>
  </ul>
  
  <h5 class="quiz-question">What is your opinion of the word "intarsia"?</h5>
  <ul data-quiz-question="4">
    <li class="quiz-answer" data-quiz-answer="a">he</li>
    <li class="quiz-answer" data-quiz-answer="b">knowses</li>
    <li class="quiz-answer" data-quiz-answer="c">his</li>
    <li class="quiz-answer" data-quiz-answer="d">toeses</li>
  </ul>
  
  <h5 class="quiz-question">What is the name of the fly on the wall?</h5>
  <ul data-quiz-question="5">
    <li class="quiz-answer" data-quiz-answer="a">aren't</li>
    <li class="quiz-answer" data-quiz-answer="b">roses</li>
    <li class="quiz-answer" data-quiz-answer="c">as</li>
    <li class="quiz-answer" data-quiz-answer="d">moses</li>
  </ul>
  
  <h5 class="quiz-question">Sew it seems you gotten to the end of the quiz....yes?</h5>
  <ul data-quiz-question="6">
    <li class="quiz-answer" data-quiz-answer="a">supposes</li>
    <li class="quiz-answer" data-quiz-answer="b">his</li>
    <li class="quiz-answer" data-quiz-answer="c">toeses</li>
    <li class="quiz-answer" data-quiz-answer="d">to be</li>
  </ul>

  <div class="quiz-result"></div>
</div>

</div>

<div class="quiz" id="third" style="display: none;">

<img src="imgs/quizzes/backbutton.jpg" alt="back button" id="back3" class="backBtnImg">

<div class="quizContent">

  <h4>What on-screen kntting scene are you?</h4>
  
  <h5 class="quiz-question">i'll add real questions when i find the bug</h5>
  <ul data-quiz-question="1">
    <li class="quiz-answer" data-quiz-answer="a">moses</li>
    <li class="quiz-answer" data-quiz-answer="b">supposes</li>
    <li class="quiz-answer" data-quiz-answer="c">his</li>
    <li class="quiz-answer" data-quiz-answer="d">toeses</li>
  </ul>
  
  <h5 class="quiz-question">Are you knitty?</h5>
  <ul data-quiz-question="2">
    <li class="quiz-answer" data-quiz-answer="a">are</li>
    <li class="quiz-answer" data-quiz-answer="b">roses</li>
    <li class="quiz-answer" data-quiz-answer="c">but</li>
    <li class="quiz-answer" data-quiz-answer="d">moses</li>
  </ul>
  
  <h5 class="quiz-question">Are you gritty?</h5>
  <ul data-quiz-question="3">
    <li class="quiz-answer" data-quiz-answer="a">supposes</li>
    <li class="quiz-answer" data-quiz-answer="b">erroneously</li>
    <li class="quiz-answer" data-quiz-answer="c">for</li>
    <li class="quiz-answer" data-quiz-answer="d">moses</li>
  </ul>
  
  <h5 class="quiz-question">What is your opinion of the word "intarsia"?</h5>
  <ul data-quiz-question="4">
    <li class="quiz-answer" data-quiz-answer="a">he</li>
    <li class="quiz-answer" data-quiz-answer="b">knowses</li>
    <li class="quiz-answer" data-quiz-answer="c">his</li>
    <li class="quiz-answer" data-quiz-answer="d">toeses</li>
  </ul>
  
  <h5 class="quiz-question">What is the name of the fly on the wall?</h5>
  <ul data-quiz-question="5">
    <li class="quiz-answer" data-quiz-answer="a">aren't</li>
    <li class="quiz-answer" data-quiz-answer="b">roses</li>
    <li class="quiz-answer" data-quiz-answer="c">as</li>
    <li class="quiz-answer" data-quiz-answer="d">moses</li>
  </ul>
  
  <h5 class="quiz-question">Sew it seems you gotten to the end of the quiz....yes?</h5>
  <ul data-quiz-question="6">
    <li class="quiz-answer" data-quiz-answer="a">supposes</li>
    <li class="quiz-answer" data-quiz-answer="b">his</li>
    <li class="quiz-answer" data-quiz-answer="c">toeses</li>
    <li class="quiz-answer" data-quiz-answer="d">to be</li>
  </ul>

  <div class="quiz-result"></div>
  
</div>
</div>

<div class="quiz" id="fourth" style="display: none;">

<img src="imgs/quizzes/backbutton.jpg" alt="back button" id="back4" class="backBtnImg">

<div class="quizContent">

  <h4>Take this quiz to test your knitting trivia!</h4>
  
  <h5 class="quiz-question">i'll add real questions when i find the bug</h5>
  <ul data-quiz-question="1">
    <li class="quiz-answer" data-quiz-answer="a">moses</li>
    <li class="quiz-answer" data-quiz-answer="b">supposes</li>
    <li class="quiz-answer" data-quiz-answer="c">his</li>
    <li class="quiz-answer" data-quiz-answer="d">toeses</li>
  </ul>
  
  <h5 class="quiz-question">Are you knitty?</h5>
  <ul data-quiz-question="2">
    <li class="quiz-answer" data-quiz-answer="a">are</li>
    <li class="quiz-answer" data-quiz-answer="b">roses</li>
    <li class="quiz-answer" data-quiz-answer="c">but</li>
    <li class="quiz-answer" data-quiz-answer="d">moses</li>
  </ul>
  
  <h5 class="quiz-question">Are you gritty?</h5>
  <ul data-quiz-question="3">
    <li class="quiz-answer" data-quiz-answer="a">supposes</li>
    <li class="quiz-answer" data-quiz-answer="b">erroneously</li>
    <li class="quiz-answer" data-quiz-answer="c">for</li>
    <li class="quiz-answer" data-quiz-answer="d">moses</li>
  </ul>
  
  <h5 class="quiz-question">What is your opinion of the word "intarsia"?</h5>
  <ul data-quiz-question="4">
    <li class="quiz-answer" data-quiz-answer="a">he</li>
    <li class="quiz-answer" data-quiz-answer="b">knowses</li>
    <li class="quiz-answer" data-quiz-answer="c">his</li>
    <li class="quiz-answer" data-quiz-answer="d">toeses</li>
  </ul>
  
  <h5 class="quiz-question">What is the name of the fly on the wall?</h5>
  <ul data-quiz-question="5">
    <li class="quiz-answer" data-quiz-answer="a">aren't</li>
    <li class="quiz-answer" data-quiz-answer="b">roses</li>
    <li class="quiz-answer" data-quiz-answer="c">as</li>
    <li class="quiz-answer" data-quiz-answer="d">moses</li>
  </ul>
  
  <h5 class="quiz-question">Sew it seems you gotten to the end of the quiz....yes?</h5>
  <ul data-quiz-question="6">
    <li class="quiz-answer" data-quiz-answer="a">supposes</li>
    <li class="quiz-answer" data-quiz-answer="b">his</li>
    <li class="quiz-answer" data-quiz-answer="c">toeses</li>
    <li class="quiz-answer" data-quiz-answer="d">to be</li>
  </ul>

  <div class="quiz-result"></div>
</div>
</div>

</div>

<script>

var Quiz = function(){
  var self = this;
  this.init = function(){
    self._bindEvents();
  }
  
  var tiffany = [
    { question: 1, answer: 'a' },
    { question: 2, answer: 'b' },
    { question: 3, answer: 'd' },
    { question: 4, answer: 'c' },
    { question: 5, answer: 'd' },
    { question: 6, answer: 'b' },
  ]

  var harry = [
    { question: 1, answer: 'b' },
    { question: 2, answer: 'c' },
    { question: 3, answer: 'c' },
    { question: 4, answer: 'd' },
    { question: 5, answer: 'b' },
    { question: 6, answer: 'a' },
  ]

  var yarn = [
    { question: 1, answer: 'c' },
    { question: 2, answer: 'b' },
    { question: 3, answer: 'a' },
    { question: 4, answer: 'd' },
    { question: 5, answer: 'a' },
    { question: 6, answer: 'c' },
  ]

  var gromit = [
    { question: 1, answer: 'd' },
    { question: 2, answer: 'a' },
    { question: 3, answer: 'b' },
    { question: 4, answer: 'c' },
    { question: 5, answer: 'b' },
    { question: 6, answer: 'b' },
  ]
  
  this._pickAnswer = function($answer, $answers){
    $answers.find('.quiz-answer').removeClass('active');
    $answer.addClass('active');
  }
  this._calcResult = function(){
    var numberOfCorrectAnswers = 0;
    $('ul[data-quiz-question]').each(function(i){
      var $this = $(this),
          chosenAnswer = $this.find('.quiz-answer.active').data('quiz-answer'),
          correctAnswer;
      
      for ( var j = 0; j < self.correctAnswers.length; j++ ) {
        var a = self.correctAnswers[j];
        if ( a.question == $this.data('quiz-question') ) {
          correctAnswer = a.answer;
        }
      }
      
      if ( chosenAnswer == correctAnswer ) {
        numberOfCorrectAnswers++;
      }
    });
    if ( numberOfCorrectAnswers < 3 ) {
      return {code: 'bad', text: 'you are thicc yarn'};
    }
    else if ( numberOfCorrectAnswers == 3 || numberOfCorrectAnswers == 4 ) {
      return {code: 'mid', text: 'you are delicate yarn'};
    }
    else if ( numberOfCorrectAnswers > 4 ) {
      return {code: 'good', text: 'you are the living embodiment of yarn'};
    }
  }
  this._isComplete = function(){
    var answersComplete = 0;
    $('ul[data-quiz-question]').each(function(){
      if ( $(this).find('.quiz-answer.active').length ) {
        answersComplete++;
      }
    });
    if ( answersComplete >= 6 ) {
      return true;
    }
    else {
      return false;
    }
  }
  this._showResult = function(result){
    $('.quiz-result').addClass(result.code).html(result.text);
  }
  this._bindEvents = function(){
    $('.quiz-answer').on('click', function(){
      var $this = $(this),
          $answers = $this.closest('ul[data-quiz-question]');
      self._pickAnswer($this, $answers);
      if ( self._isComplete() ) {
        
        // scroll to answer section
        $('html, body').animate({
          scrollTop: $('.quiz-result').offset().top
        });
        
        self._showResult( self._calcResult() );
        $('.quiz-answer').off('click');
        
      }
    });
  }
}
var quiz = new Quiz();
quiz.init();

</script>

</div>