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
    <title> Admin-Location </title>
    <meta charset = "utf-8">
  </head>
  <body>
	<?php include 'header.php'; ?>
	<?php include 'adminwelcome.php'; ?>
	<br>
	<?php include 'adminmenu.php'; ?>
	<br>
	<script src = "roster.js"></script>
	<form name="form1" method="POST">
		<center>Search:
			<select id="myDropdown" onchange="itemSelected();">
				<option value="location">Location</option>
			</select>
			<input type = "text" id="searchTarget">
			<input type="submit" value="Submit" name="submit" onclick="showSearch();">
		</center><br>
	</form>
	<center>
		<button class="createButton" id="creatRosId" type="button" onclick="newRosForm();">
			Create Location</button>
		<div class="form-style" id="newForm">
			<div class="form-style-heading">Location Information: </div>
			<form action="" method="post">
				<label><span>Location ID: </span><input type="text" class="input-field" id="loc" value="" /></label>
				<label><span>Room Number: </span><input type="text" class="input-field" id="room" value="" /></label>
				<label><span>Building: </span><input type="text" class="input-field" id="bldg" value="" /></label>
				<label><span>Locked: </span><select type="text" class="select-field" id="lock" value="">				
					<option value="lock">Locked</option>
					<option value="unlock">Unlock</option>
				</select></label>
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