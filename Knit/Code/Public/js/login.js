/* This code feeds login input to the backend and returns feedback to user
@author Alexis
Last modified 12/16/2020 */

/* jquery function for passing on user login input to php */
$(document).ready(function(){
	$("#loginSubmit").click(function(){ /* when submit button clicked */
		/* get the input values and save to dataString variable */
		var loginUname = $("#loginUname").val();
		var loginPsw = $("#loginPsw").val();
		var dataString = 'loginUname='+ loginUname + '&loginPsw='+ loginPsw;
		$.ajax({
			type: "GET",
			url: "php/login.php",
			data: dataString, // pass dataString to php
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
