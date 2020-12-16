/* This code feeds registration input to the backend and returns feedback to user
@author Alexis
Last modified 12/16/2020 */

/* jquery function for passing on user registration input to php */
$(document).ready(function(){
	$("#regSubmit").click(function(){ /* when submit button clicked */
		/* get the input values and save to dataString variable */
		var regUname = $("#regUname").val();
		var regPsw = $("#regPsw").val();
		var confPsw = $("#confPsw").val();
		var dataString = 'regUname='+ regUname + '&regPsw='+ regPsw + '&confPsw='+ confPsw;
		$.ajax({
			type: "GET",
			url: "php/register.php",
			data: dataString, // pass dataString to php
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
