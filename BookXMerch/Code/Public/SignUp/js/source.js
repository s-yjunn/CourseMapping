/* AJAX CODE FOR SIGNUP */
$("button#signupSubmit").click( function() {
    $.post($("#signupForm").attr("action"),
           $("#signupForm :input").serializeArray(),
           //callback function
           function(data) {
             $("div#signupAck").html(data);
           });
    $("#signupForm").submit(function() {
      return false;
    });
  
  });