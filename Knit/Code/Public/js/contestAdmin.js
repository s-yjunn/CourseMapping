/**
 * This function makes the buttons for the contest portion of the admin page functional
 * author @Bethany
 */

 //if user presses "preview winners"
$("#showWin").click(function(){
    //get number admin submitted
  var numWinners = document.forms["numWin"]["numWinners"].value;
  //send to php to process
$.ajax({
type: "POST",
url: "php/moveWin.php",
data: {numWinners:numWinners},
//if successful
success: function() {
    //load slideshow preview
    $("#preview").load("php/preview.php");
    $.get("php/check.php", function(){
        //get number of contestants from temp txt file
        $.get("temp/numConts.txt", function(data){
            //if there are valid contestants
            if(parseInt(data) > 0){
                //show confirm button
              $("#confirm").show();     
            }
            //delete temp txt file
            $.get("php/delNum.php");    
          });
      });
      
}
});      
//show preview winners button
$("#showWin").show();
});
//if admin confirms winners
$("#confirm").click(function(){
    //reset contest
    $.get("php/reset.php", function(){
    //hide confirm button & slidehsow preview
    $("#confirm").hide();
    $("#preview").hide();
    //refresh winners, vote, and preview winners div to update & reflect the reset
    $("#Winners").load(location.href+" #Winners>*","");
    $("#section3").load(location.href+" #section3>*","");
    $("#Vote").load(location.href+" #Vote>*","");
  });
});
//if admin presses delete button
$("#delete").click(function(){
    //array will hold submissions to be deleted
    var deleteSub = [];
        //for each selected submission....
        $.each($("#deleteSubs option:selected"), function(){      
            //....add to array      
            deleteSub.push($(this).val());
        });
//send array to php file to be dealt with
$.ajax({
type: "POST",
url: "php/deleteConts.php",
data: {deleteSubs:deleteSub},
//if successful....
success: function() {
    //....reload approve/delete sections
    $("#section2").load(location.href+" #section2>*","");
    $("#section1").load(location.href+" #section1>*","");    
}
});      
});
//if admin presses approve button
$("#approve").click(function(){
    //array will hold submissions to be approved
    var currentSub = [];
    //for each selected submission....
        $.each($("#currentSubs option:selected"), function(){  
            //....add to array            
            currentSub.push($(this).val());
        });
//send array to php file to be dealt with
$.ajax({
type: "POST",
url: "php/moveConts.php",
data: {currentSubs:currentSub},
//if successful....
success: function() {
    //....reload approve,delete, preview, & vote sections
    $("#section2").load(location.href+" #section2>*","");
    $("#section1").load(location.href+" #section1>*","");
    $("#section3").load(location.href+" #section3>*","");
    $("#Vote").load(location.href+" #Vote>*","");
    
}
});      
});
