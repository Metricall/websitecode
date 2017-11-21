<?php
session_start();
?>
<?php
	include 'LoginUtilities.php';
	if (checkLogin()) {
		//not an admin
		if ($_SESSION["role"] != "Admin")
			header("Location: logout.php");
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
    <title> Admin-Reports </title>
    <meta charset = "utf-8">
  </head>
  <body>
	<?php include 'header.php'; ?>
	<?php include 'adminmenu.php'; ?>
	<?php include 'admindrop.php'; ?>
	<center>
		<button class="createButton" id="creatRosId" type="button" onclick="newRosForm();">
			Create Report</button>
			<div class="form-style-heading">Probably just search for instructor, choose one, then redirect to professor pages.<br><br> </div>
		<div class="form-style" id="newForm">
			<div class="form-style-heading">Session Information (need update to report input form): </div>
			<form action="" method="post">
				<label><span>Session ID: </span><input type="text" id="ses" class="input-field" value=""></label>
				<label><span>Roster ID: </span><input type="text" id="id" class="input-field" value=""></label>
				<label><span>Professor:	</span><input type="text" id="prof" class="input-field" value=""></label>
				<label><span>Location: </span><input type="text"id="loc" class="input-field" value=""></label>
				<label><span>Start time: </span><input type="text"id="start" class="input-field" value=""></label>
				<label><span>End Time: </span><input type="text"id="end" class="input-field" value=""></label>
				<label><span>Date: </span><input type="text"id="date" class="input-field" value=""></label>
				<label><span>Attended:	</span><input type="text"id="attend" class="input-field" value=""></label>
				<label><span>&nbsp;</span><input type="submit" value="Submit" onclick="submitNew();"/></label>
			</form>
		</div>
	</center><br>
	<center>
		<table id="infoTable" class="infoTable">
			
		</table>
	</center>
	<?php include 'footer.php'; ?>
  </body>
</html>