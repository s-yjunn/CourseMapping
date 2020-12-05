<!DOCTYPE html>
<html>
<?php
include ("vars/header.php");
include ("vars/navbar.php");
include ("src/search.php");

if (isset($_GET['desc']))
{
    $results = (search_store($_GET['desc']));
}
else
{
    $_GET['desc'] = 'nothing';
    $results = (search_store($_GET['desc']));
}
?>

	<body>
		<section class="section" id="body">
			<div class="container">
				<h1 class="title">Searching for "<?php echo $_GET['desc']; ?>"...</h1>
				<form class="field" action="search.php" method="GET">
					<div class="control">
						<input class="input is-rounded" type="text" name="desc" value="<?php echo $_GET['desc']; ?>"> </div>
				</form>
				<br/>
				<div class="columns is-multiline">
					<?php display_items($results); ?> </div>
			</div>
		</section>
		<?php
include ("vars/footer.php");
?>
	</body>

</html>
