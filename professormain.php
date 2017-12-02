<?php
session_start();
?>
<?php
	include 'LoginUtilities.php';
	include 'DatabaseUtilities.php';
	if (checkLogin()) {
		//not an admin or insturctor
		if ($_SESSION["role"] != "Admin" AND $_SESSION["role"] != "Professor")
			header("Location: logout.php");
		//if it's an admin but has not chosen a professor
		elseif($_SESSION["role"] == "Admin" AND !isset($_SESSION["instructorID"]))
			header("Location: adminmain.php");
		//professor user id is assigned as instructor id
		elseif ($_SESSION["role"] == "Professor")
			$_SESSION["instructorID"] = $_SESSION["uid"];
	}
	$pagetype = "Professor";
	
	//add professor name to PHP session
	if (isset($_SESSION["instructorID"])) {
		$fn = getUserFirstName($_SESSION["instructorID"]);
		$ln = getUserLastName($_SESSION["instructorID"]);
	}
	$_SESSION["instructorName"] =  "{$fn} {$ln}";
	
	include 'roster_functions.php';
	//if upon choosing a roster, save to PHP session and redirect
	if(isset($_POST["rid"])) {
		$_SESSION["rid"] = $_POST["rid"];
		header("Location: professorclass.php");
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
	<div class = 'row' id = 'yourclasses'>
	<div class = 'col-xs-12' align="center">
	<h2>Your Rosters:</h2>
	<h3>
	<?php rosterlist($_SESSION["instructorID"]); ?>
	<br><br>
	</h3>
	</div>
	</div>
	<?php include 'footer.php'; ?>
</html>