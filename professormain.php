<?php
session_start();
?>
<?php
	include 'LoginUtilities.php';
	if (checkLogin()) {
		//if it's an admin but has not chosen a professor
		if($_SESSION["role"] == "Admin" AND !isset($_SESSION["instructorID"]))
			header("Location: adminmain.html");
		//professor user id is assigned as instructor id
		elseif ($_SESSION["role"] == "Professor")
			$_SESSION["instructorID"] = $_SESSION["uid"];
		//not an admin or insturctor
		elseif ($_SESSION["role"] != "Admin" AND $_SESSION["role"] != "Professor")
			header("Location: logout.php");
	}
	else
		header("Location: logout.php");
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
  <div class = 'row' id = 'logo'>
	<div class = 'col-xs-1'></div>
	<div class = 'col-xs-3'><h2>M e t r i c a l </h2></div>
	<div class = 'col-xs-4'><a href = 'professorclasses.html'><img src = 'metrical3.png' width = '80px' ></a></div>
	<div class = 'col-xs-5'></div>
	</div>
	<div class = 'row' id = 'taskbar'>
	<div class = 'col-xs-1'></div>
	<div class = 'col-xs-2'><a href = 'createsession.html'><h4>Create Session</h4></a></div>
	<div class = 'col-xs-2'><a href = 'generatereport.html'><h4>Generate Report</h4></a></div>
	<div class = 'col-xs-2'><a href = 'editstudents.html'><h4>Edit Students</h4></a></div>
	<div class = 'col-xs-2'><a href = 'contactus.html'><h4>Contact Us</h4></a></div>
	<div class = 'col-xs-2'><a href = 'metricalsite.html'><h4>Logout</h4></a></div>
	</div><br><br>
	
	<div class = 'row' id = 'yourclasses'>
	<div class = 'col-xs-5'></div>
	<div class = 'col-xs-7'><h2>Hello <?php include 'DatabaseUtilities.php'; print getUserFirstName($_SESSION["instructorID"]) . " " . getUserLastName($_SESSION["instructorID"]); ?>, let's begin.</h2></div>
	
	</div>

</html>