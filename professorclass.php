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
	include 'session_functions.php';
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
	<div class = 'row' id = 'yourclasses'>
		<div class = 'col-xs-12' align='center'><h2>Choose an action.</h2></div>
		<br>
		<div class = 'col-xs-12' align='center'><h4>
		Sessions:<br>Create new sessions to take attendance for this Roster.  Manage existing sessions.
		<br><br>
		Reports:<br>View current attendance records.
		<br><br>
		Manage Attendance:<br>Change excused absenses to attended.  Or remove a student from attendance if necessary.
		<br><br>
		</h4></div>
	</div><br>

	<?php include 'footer.php'; ?>
  </body>
</html>