<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>2Twenty Marketplace</title>
	<link rel="stylesheet" href="css/bulma.css">
	<link rel="stylesheet" href="css/twenty.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
	<script type="text/javascript">
	// for mobile burger and "See more" button on front page.
	$(document).ready(function() {
		$(".navbar-burger").click(function() {
			$(".navbar-burger").toggleClass("is-active");
			$(".navbar-menu").toggleClass("is-active");
		});
		$("#login").click(function() {
			$("#login-modal").toggleClass("is-active");
		});
		$(".modal-close").click(function() {
			$("#login-modal").toggleClass("is-active");
		});
		$("#good-login > .delete").click(function() {
			$("#good-login").remove();
		});
		$("#bad-login > .delete").click(function() {
			$("#bad-login").remove();
		});
		$("#good-login").draggable();
		$("#bad-login").draggable();
		$("#more").click(function() {
			$("body,html").animate({
				scrollTop: $("#body").offset().top
			}, 300);
		});
	});
	</script>
</head>