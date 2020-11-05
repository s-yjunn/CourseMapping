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
	            $('#loginDiv').html(result);					
			}
		});
	});
});
