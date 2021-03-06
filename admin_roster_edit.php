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

	include 'roster_functions.php';
	//set roster to PHP session and refresh page
	if(isset($_REQUEST["roster"])){
		$_SESSION["roster"] = $_REQUEST["roster"];
		header("Location: admin_roster_edit.php");
	}
	//if no active roster, redirect back to choose roster
	if(!isset($_SESSION["roster"])){
		header("Location: admin_roster.php");
	}
	else{
		$currentroster = $_SESSION["roster"];
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
    <title> Admin-Roster </title>
    <meta charset = "utf-8">
  </head>
  <body>
	<?php include 'header.php'; ?>
	<br>
	<center>
		<div class="form-style-heading">
		<?php echo getRosterCourseName($currentroster); ?>
		<br>
		Find user to add:
		</div>
	</center>
	<?php include 'search_users.php'; ?>
	<center>
		<table id="infoTable" class="infoTable">
		<?php
		//searched for and found user to add
		if(isset($_POST["userchoice"])) {
			$addsuccess = addstudent($currentroster, $_POST["userchoice"]);
			if($addsuccess){
				echo "Student added to roster.<br><br>";
			}
			else{
				echo "Failure. Student could not be added to roster.<br><br>";
			}
		}
		//selected an existing user in roster to remove
		if(isset($_POST["removeuid"])) {
			$removesuccess = removestudent($currentroster, $_POST["removeuid"]);
			if($removesuccess){
				echo "Student removed from roster.<br><br>";
			}
			else{
				echo "Failure. Student could not be removed from roster.<br><br>";
			}
		}
		?>
		<br><br><br>
		<h4>Students in this Roster:</h4>
		<?php showstudentlist($currentroster, true); ?>
		</table>
	</center>
	<?php include 'footer.php'; ?>
  </body>
</html>