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
    <title> Admin-User </title>
    <meta charset = "utf-8">
  </head>
  <body>
	<?php include 'header.php'; ?>
	<?php include 'adminmenu.php'; ?>
	<?php include 'admindrop.php'; ?>
	<center>
		<button class="createButton" id="creatRosId" type="button" onclick="newRosForm();">
			Create User</button>
		<div class="form-style" id="newForm">
			<div class="form-style-heading">User Information: </div>
			<form action="" method="post">
				<label><span>First Name: </span><input type="text" class="input-field" id="first" value="" /></label>
				<label><span>Last Name: </span><input type="text" class="input-field" id="last" value="" /></label>
				<label><span>Role: </span><input type="text" class="input-field" id="role" value="" /></label>
				<label><span>User ID: </span><input type="text" class="input-field" id="userID" value="" /></label>
				<label><span>Password: </span><input type="text" class="input-field" id="password" value="" /></label>
				<label><span>Email: </span><input type="text" class="input-field" id="email" value="" /></label>
				<label><span>Finger Print: </span><input type="text" class="input-field" id="finger" value="" /></label>
				<label><span>Active: </span><select type="text" class="select-field" id="active" value="" />
					<option value="act">Active</option>
					<option value="inAct">Inactive</option>
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