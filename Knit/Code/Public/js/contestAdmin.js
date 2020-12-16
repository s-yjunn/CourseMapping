$("#showWin").click(function(){
  var numWinners = document.forms["numWin"]["numWinners"].value;
$.ajax({
type: "POST",
url: "php/moveWin.php",
data: {numWinners:numWinners},
success: function() {
    $("#preview").load("php/preview.php");
    $.get("php/check.php", function(){
        $.get("temp/numConts.txt", function(data){
            if(parseInt(data) > 0){
              $("#confirm").show();     
            }
            $.get("php/delNum.php");    
          });
      });
      
}
});      

$("#showWin").show();
});

$("#confirm").click(function(){
    $.get("php/reset.php", function(){
    $("#confirm").hide();
    $("#preview").hide();
    $("#Winners").load(location.href+" #Winners>*","");
    $("#section3").load(location.href+" #section3>*","");
  });
});
$("#delete").click(function(){
    var deleteSub = [];
        $.each($("#deleteSubs option:selected"), function(){            
            deleteSub.push($(this).val());
        });
$.ajax({
type: "POST",
url: "php/deleteConts.php",
data: {deleteSubs:deleteSub},
success: function() {
    $("#section2").load(location.href+" #section2>*","");
    $("#section1").load(location.href+" #section1>*","");    
}
});      
});
$("#approve").click(function(){
    var currentSub = [];
        $.each($("#currentSubs option:selected"), function(){            
            currentSub.push($(this).val());
        });
$.ajax({
type: "POST",
url: "php/moveConts.php",
data: {currentSubs:currentSub},
success: function() {
    $("#section2").load(location.href+" #section2>*","");
    $("#section1").load(location.href+" #section1>*","");
    $("#section3").load(location.href+" #section3>*","");
     
    
}
});      
});
