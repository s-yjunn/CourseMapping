<html>
<body>
<?php 
$username = $_POST["username"];
$password = $_POST["password"];

$_SESSION["username"] = $username;

$_SESSION["loggedin"] = true;

echo $_SESSION["username"] . "<br>";
?>

<a href="../index.html.php">Go Back</a>

</body>
</html>