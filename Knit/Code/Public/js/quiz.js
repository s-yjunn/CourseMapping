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