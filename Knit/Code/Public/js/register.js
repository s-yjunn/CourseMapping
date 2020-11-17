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
					// let the user know the registration worked
					$("#regDiv").html("<p>Registration successful.</p>");
					// add a message about their login status to the top of the page
					$("#loggedIn").html("You are logged in as " + regUname + ". <a onclick = 'logOut()'>Log out</a>");
					// load user page
					$("#User").load(location.href+" #User>*","");
					// show and hide the proper tablinks
					$("#accountTabs").load(location.href+" #accountTabs>*","");
					$("#loginTabs").load(location.href+" #loginTabs>*","");
					// reload the forum tab (so they can post under this username)
					$("#Forum").load(location.href+" #Forum>*","");
					// go to user page
					openTab(event, "User");
				} else {
					// if unsuccessful, output the failure message
					$("#regDiv").html(result);
				}			
			}
		});
	});
});
