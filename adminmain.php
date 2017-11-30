<?php
session_start();
?>
<?php
	include 'LoginUtilities.php';
	if (checkLogin()) {
		//not an admin
		if ($_SESSION["role"] != "Admin")
			header("Location: logout.php");
		//setup adminID
		elseif($_SESSION["role"] == "Admin")
			$_SESSION["adminID"] = $_SESSION["uid"];
	}
	$pagetype = "Admin";

	include 'DatabaseUtilities.php';
	$fn = getUserFirstName($_SESSION["adminID"]);
	$ln = getUserLastName($_SESSION["adminID"]);
	$_SESSION["adminName"] =  "{$fn} {$ln}";
?>
<!DOCTYPE html>
<!--admin
 -->
<html lang = "en">
  <head>
    <link rel = "stylesheet" type = "text/css" href = "bootstrap.css">
	<link rel = "stylesheet" type = "text/css" href = "mainmetrical.css">
	<link rel = "stylesheet" type = "text/css" href = "roster.css">
    <title> Administrator </title>
    <meta charset = "utf-8">
  </head>
  <body>
	<?php include 'header.php'; ?>
	<br><br><br><br><br><br>
	<?php include 'footer.php'; ?>
  </body>
</html>