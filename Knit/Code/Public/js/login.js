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
					// let the user know the login worked
					$("#loginDiv").html("<p>Login successful.</p>");
					// add a message about their login status to the top of the page
					$("#loggedIn").html("You are logged in as " + loginUname + ". <a onclick = 'logOut()'>Log out</a>");
					// if logged in as admin
					if (loginUname === "admin") {
						// load admin page
						$("#Admin").load(location.href+" #Admin>*","");
						// show tablink to admin page
						$("#adminTab").show();
					// if normal user
					} else {
						// load user page
						$("#User").load(location.href+" #User>*","");
						// show tablink to user page
						$("#userTab").show();
					}
					// reload the forum tab (so they can post under this username)
					$("#Forum").load(location.href+" #Forum>*","");
				} else {
					// if unsuccessful, output the failure message
					$("#loginDiv").html(result);
				}			
			}
		});
	});
});
