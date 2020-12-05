$(document).ready(function(){
	$("#loginSubmit").click(function(){
		var loginUname = $("#loginUname").val();
		var loginPsw = $("#loginPsw").val();
		var dataString = 'loginUname='+ loginUname + '&loginPsw='+ loginPsw;
		$.ajax({
			type: "GET",
			url: "php/login.php",
			data: dataString,
	    success: function(result) {
				// if login.php returns a success message,
				if (result === "Success") {
					//reload!
					window.location.reload();
				} else {
					// if unsuccessful, output the failure message
					$("#loginDiv").html(result);
				}			
			}
		});
	});
});
