/**
 * This file handles all of the buttons for the quiz tab
 * author @Bethany
 * 
 * code adapted from https://codepen.io/tgallimore/pen/xwGOXB
 */


var Quiz = function () {
    var self = this;
    this.init = function () {
      self._bindEvents();
    };
  //answers
    this.correctAnswers = [
      { question: 1, answer: "a" },
      { question: 2, answer: "b" },
      { question: 3, answer: "d" },
      { question: 4, answer: "c" },
      { question: 5, answer: "d" },
      { question: 6, answer: "b" },
      { question: 7, answer: 'a' },
      { question: 8, answer: 'c' },
      { question: 9, answer: 'd' },
      { question: 10, answer: 'b' }
    ];
  //find selected answer
    this._pickAnswer = function ($answer, $answers) {
      $answers.find(".quiz-answer").removeClass("active");
      $answer.addClass("active");
    };
    this._calcResult = function () {
      var numberOfCorrectAnswers = 0;
      //for each question in quiz....
      $("ul[data-quiz-question]").each(function (i) {
        var $this = $(this),
        //chosenAnswer = find the answer user selected
          chosenAnswer = $this.find(".quiz-answer.active").data("quiz-answer"),
          correctAnswer;
        //loop through num correct answers
        for (var j = 0; j < self.correctAnswers.length; j++) {
          //get correct answer from array
          var a = self.correctAnswers[j];
          //if question is in array...
          if (a.question == $this.data("quiz-question")) {
            //...question is correct
            correctAnswer = a.answer;
          }
        }
        //if user selected the correct answer...
        if (chosenAnswer == correctAnswer) {
          //inc num correct
          numberOfCorrectAnswers++;
  
          // find correct answers - mark green
          $this.find(".quiz-answer.active").addClass("correct");
        } else {
          //find incorrect answers - mark red 
          $this
            .find('.quiz-answer[data-quiz-answer="' + correctAnswer + '"]')
            .addClass("correct");
          $this.find(".quiz-answer.active").addClass("incorrect");
        }
      });
      //if user got max 3 right
      if (numberOfCorrectAnswers <= 3) {
        //they have poor knitting knowledge
        return { code: "bad", text: "You have poor knitting knowledge" };
        //if user got more than three but max eight right
      } else if (numberOfCorrectAnswers > 3 && numberOfCorrectAnswers <= 8) {
        //they have moderate knitting knowledge
        return { code: "mid", text: "You have moderate knitting knowledge" };
        //if user got at least 90% right
      } else if (numberOfCorrectAnswers > 8) {
        //they have great knitting knowledge
        return { code: "good", text: "You have great knitting knowledge" };
      }
    };
    this._isComplete = function () {
      //check answers to see how many user selected
      var answersComplete = 0;
      $("ul[data-quiz-question]").each(function () {
        if ($(this).find(".quiz-answer.active").length) {
          answersComplete++;
        }
      });//if user selected ten answers
      if (answersComplete >= 10) {
        //quiz over
        return true;
      } else {
        return false;
      }
    };
    this._showResult = function (result) {//get color and text from this._calcResult
      $(".quiz-result").addClass(result.code).html(result.text);
    };
    this._bindEvents = function () {//put it all together
      $(".quiz-answer").on("click", function () {
        var $this = $(this),
          $answers = $this.closest("ul[data-quiz-question]");
        self._pickAnswer($this, $answers);
        if (self._isComplete()) {
  
          self._showResult(self._calcResult());
          $(".quiz-answer").off("click");
        }
      });
    };
  };
  
  var quiz = new Quiz();
  quiz.init();