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
				$('#regDiv').html(result);
				if (result = "<p>Registration successful.</p>") {
					$("#Forum").load(location.href+" #Forum>*","");
				}
			}
		});
	});
});
