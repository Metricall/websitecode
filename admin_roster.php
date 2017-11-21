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
    <title> Admin-Roster </title>
    <meta charset = "utf-8">
  </head>
  <body>
	<?php include 'header.php'; ?>
	<?php include 'adminmenu.php'; ?>
	<?php include 'admindrop.php'; ?>
	<center>
		<button class="createButton" id="creatRosId" type="button" onclick="newRosForm();">
			Create Roster</button>		
		<div class="form-style" id="newForm">
			<div class="form-style-heading">Roster Information: </div>
			<form action="" method="post">
				<label><span>Course Name: </span><input type="text" class="input-field" id="id" value="" /></label>
				<label><span>Professor: </span><input type="text" class="input-field" id="prof" value="" /></label>
				<label><span>Location: </span><input type="text" class="input-field" id="loc" value="" /></label>
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