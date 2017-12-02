<?php
session_start();
?>
<?php
	include 'LoginUtilities.php';
	include 'DatabaseUtilities.php';
	if (checkLogin()) {
		//not an admin
		if ($_SESSION["role"] != "Admin")
			header("Location: logout.php");
	}
	$pagetype = "Admin";
	
	//if professor chosen, put them in PHP session and redirect to professor pages
	if(isset($_POST["profchoice"])) {
		$_SESSION["instructorID"] = $_POST["profchoice"];
		header("Location: professormain.php");
	}
?>
<!DOCTYPE html>
<!--admin
 -->
<html lang = "en">
  <head>
    <link rel = "stylesheet" type = "text/css" href = "bootstrap.css">
	<link rel = "stylesheet" type = "text/css" href = "mainmetrical.css">
	<link rel = "stylesheet" type = "text/css" href = "roster.css">
    <title> Admin-Sessions </title>
    <meta charset = "utf-8">
  </head>
  <body>
	<?php include 'header.php'; ?>
	<br>
	<center>
		<div class="form-style-heading">
		Search for a professor to do Sessions and Reports for:
		</div>
	</center>
	<?php include 'search_instructors.php'; ?>
	<?php include 'footer.php'; ?>
  </body>
</html>