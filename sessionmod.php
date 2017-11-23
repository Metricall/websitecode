<?php
session_start();
?>
<?php
	include 'LoginUtilities.php';
	if (checkLogin()) {
		//not an admin or insturctor
		if ($_SESSION["role"] != "Admin" AND $_SESSION["role"] != "Professor")
			header("Location: logout.php");
		//no roster chosen
		elseif (!isset($_REQUEST["sid"]))
			header("Location: professormain.php");
	}
?>
<?php
	include 'DatabaseUtilities.php';
	
	function sayclass(){
		print getRosterCourseName($_SESSION["rid"]);
	}
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
	<?php if ($_SESSION["role"] == "Admin"){include 'adminwelcome.php';echo "<br>";} ?>
	<?php include 'instructorwelcome.php'; ?>
	<div class = 'row' id = 'yourclasses'>
	<div class = 'col-xs-12' align="center"><h2>Active Class: <?php	sayclass(); ?></h2>
	<br>
	</div>
	</div>
	<?php include 'instructormenu.php'; ?>
	<br>
	<?php
		echo $_REQUEST["sid"];
	?>
	<?php include 'footer.php'; ?>
</html>