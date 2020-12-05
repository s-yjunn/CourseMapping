$(document).ready(function(){
	$("#regSubmit").click(function(){
		var regUname = $("#regUname").val();
		var regPsw = $("#regPsw").val();
		var confPsw = $("#confPsw").val();
		var dataString = 'regUname='+ regUname + '&regPsw='+ regPsw + '&confPsw='+ confPsw;
		$.ajax({
			type: "GET",
			url: "php/register.php",
			data: dataString,
	    success: function(result) {
				// if register.php returns a success message,
				if (result === "Success") {
					// reload the page!
					window.location.reload();
				} else {
					// if unsuccessful, output the failure message
					$("#regDiv").html(result);
				}			
			}
		});
	});
});
