<?php
session_start();
?>
<?php
	include 'DatabaseUtilities.php';
	include 'LoginUtilities.php';
	if (checkLogin()) {
		//not an admin or insturctor
		if ($_SESSION["role"] != "Admin" AND $_SESSION["role"] != "Professor")
			header("Location: logout.php");
		//no roster chosen
		elseif (!isset($_SESSION["rid"]))
			header("Location: professormain.php");
	}
	$pagetype = "Professor";
?>
<!DOCTYPE html>
<!--professor
 -->
<html lang = "en">
  <head>
   <link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css">
    <link rel = "stylesheet" type = "text/css" href = "mainmetrical.css">
    <title> Professor </title>
    <meta charset = "utf-8">
  </head>
  <body>
	<?php include 'header.php'; ?>
	<br>
	<?php
		if (isset($_REQUEST["act"])) {
			if ($_REQUEST["act"] == "session")
				include 'session.php';
			elseif ($_REQUEST["act"] == "report")
				include 'report.php';
			elseif ($_REQUEST["act"] == "edit")
				include 'manageattendance.php';
		}
		else
			include 'profclassdefault.php';
	?>
	<?php include 'footer.php'; ?>
</html>