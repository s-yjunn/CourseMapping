<!DOCTYPE html>
<html>
<?php
include ("vars/header.php");
include ("vars/navbar.php");
include ("src/search.php");

$_GET['desc'] = (isset($_GET['desc']) ? $_GET['desc'] : "nothing");
$_GET['sort'] = (isset($_GET['sort']) ? $_GET['sort'] : "relevance");
$_GET['order'] = (isset($_GET['order']) ? $_GET['order'] : "desc");

$results = (search_store($_GET['desc'], $_GET['sort'], $_GET['order']));
?>

	<body>
		<section class="section" id="body">
			<div class="container">
				<h1 class="title">Searching for "<?php echo $_GET['desc']; ?>"...</h1>
				<form class="field" method="GET">
					<div class="control">
						<input class="input is-rounded" type="text" name="desc" value="<?php echo $_GET['desc']; ?>">
						<div class="select is-primary is-rounded mt-4">
							<select name="order">
								<option value="desc" <?php if ($_GET['order'] == "desc") echo "selected"; ?>>Descending Order</option>
								<option value="asc" <?php if ($_GET['order'] == "asc") echo "selected"; ?>>Ascending Order</option>
							</select>
						</div> 
						<div class="select is-danger is-rounded mt-4">
							<select name="sort">
								<option value="relevance" <?php if ($_GET['sort'] == "relevance") echo "selected"; ?>>Sort by Relevance</option>
								<option value="price" <?php if ($_GET['sort'] == "price") echo "selected"; ?>>Sort by Price</option>
							</select>
						</div> 
					</div>
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
