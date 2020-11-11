
/* LOGIN ACK */
$("button#loginSubmit").click( function() {
    $.post($("#loginForm").attr("action"),
           $("#loginForm :input").serializeArray(),
           //callback function
           function(data) {
             console.log("data", data);
             $("div#loginAck").html(data);
           });
    $("#loginForm").submit(function() {
      return false;
    });
  
  });