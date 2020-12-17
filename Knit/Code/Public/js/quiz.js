/**
 * This file handles all of the buttons for the quiz tab
 * author @Bethany
 */

$(document).ready(function(){
  //show list of quizzes
  $("#all").show();
  //hide back button
  $("#back").hide();
  //when back button is selected
  $("#back").click(function(){
    //refresh all quizzes
    $("#first").load(location.href+" #first>*","");
    //show list of quizzes
    $("#all").show();
    //hide back button
    $("#back").hide();
    //hide all quizzes
    $("#first").hide();
  });
  //if the first quiz is selected from list
  $("#one").click(function(){
    //hide list
    $("#all").hide();
    //show back button
    $("#back").show();
    //show first quiz
    $("#first").show();
  });
});