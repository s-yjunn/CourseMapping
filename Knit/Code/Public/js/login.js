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
				if (result === "Success" || result === "Success-admin") {
					// clear any error messages from the login div
					$("#loginDiv").html("");
					// add a login status message to the top of the page
					$("#loggedIn").html("You are logged in as " + loginUname + ". <a onclick = 'logOut()'>Log out</a>");
					// load user page
					$("#User").load(location.href+" #User>*","");
					// if logged in as admin,
					if (result === "Success-admin") {
						// additionally load admin page
						$("#Admin").load(location.href+" #Admin>*","");
					}
					// show and hide the proper tablinks
					$("#loginTabs").load(location.href+" #loginTabs>*","");
					// reload the forum tab (so they can post under this username)
					$("#Forum").load(location.href+" #Forum>*","");
					// go to user page
					openTab(event, "User");
				} else {
					// if unsuccessful, output the failure message
					$("#loginDiv").html(result);
				}			
			}
		});
	});
});
