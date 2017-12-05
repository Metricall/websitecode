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
   <?php
  
if (isset($_POST["userID"])){ //If it is the first time, it does nothing   
  validateInputForAddingUser();
}
?>
  <body>
	<?php include 'header.php'; ?>
	<br>
	<center>
		<div class="form-style-heading">
		Search for an existing user:
		</div>
	</center>
	<?php include 'search_users.php'; ?>
	<script src = "roster.js"></script>
	<center>
		<button class="createButton" id="creatRosId" type="button" onclick="newRosForm();">
			Create User</button>
		<div class="form-style" id="newForm">
			<div class="form-style-heading">User Information: </div>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<label><span>User ID: </span><input type="text" class="input-field" name="userID" value="" /></label>
				<label><span>First Name: </span><input type="text" class="input-field" name="first" value="" /></label>
				<label><span>Last Name: </span><input type="text" class="input-field" name="last" value="" /></label>
				<label><span>Role: </span>
				<select name="rolesearch" class="input-field">
				<option value="Student">Student</option>
				<option value="Professor">Professor</option>
				<option value="Admin">Admin</option>
			    </select></label>
				<label><span>Password: </span><input type="Password" class="input-field" name="password1" value="" /></label>
				<label><span>Confirm Password: </span><input type="Password" class="input-field" name="password2" value="" /></label>
				<label><span>Email: </span><input type="text" class="input-field" name="email" value="" /></label>
				<label><span>FingerPrint File #: </span><input type="text" class="input-field" name="finger" value="" /></label>
				<label><span>Active: </span><select type="text" class="select-field" name="active" value="" />
					<option value="Active">Active</option>
					<option value="Inactive">Inactive</option>
				</select></label>
				<label><span>&nbsp;</span><input type="submit" Name = "Submit_New_User" value="Submit"></label>
			</form>
		</div>
	</center><br>
	<center>
		<table id="infoTable" class="infoTable">
		<?php
		if(isset($_POST["userchoice"])) {
			echo "You chose a user.";
			echo $_POST["userchoice"];
		}
		?>
		</table>
	</center>
<?PHP
function validateInputForAddingUser() {
$the_UserID = $_POST['userID'];
$the_fName = $_POST['first'];
$the_lName = $_POST['last'];
$the_UserRole = $_POST['rolesearch'];
$the_password = $_POST['password1'];
$confirm_password = $_POST['password2'];
$the_email = $_POST['email'];
$the_active = $_POST['active'];
$the_fingerprint_code = $_POST['finger'];

$cleanfName = cleaninput($the_fName);
$cleanlName = cleaninput($the_lName);
if (strlen($cleanfName) < 1){
	echo '<script type="text/javascript">alert("ERROR: No First Name was entered."); </script>';
	return false;
}
if (strlen($cleanlName) < 1){
	echo '<script type="text/javascript">alert("ERROR: No Last Name was entered."); </script>';
	return false;
}

if (!filter_var($the_email, FILTER_VALIDATE_EMAIL)) {
  echo '<script type="text/javascript">alert("ERROR: Invalid email format"); </script>';
  return false;
}

$cleanEmail = filter_var($the_email, FILTER_VALIDATE_EMAIL);
if (checkIfEmailExists($cleanEmail) == TRUE) {
	echo '<script type="text/javascript">alert("ERROR: Email Already Exists"); </script>';
	return false;
}

$cleanUserID = filter_var($the_UserID, FILTER_VALIDATE_INT, array("options" => array("min_range"=>0, "max_range"=>999999999)));
if (!$cleanUserID){
	echo '<script type="text/javascript">alert("ERROR: No User ID was entered."); </script>';
	return false;
}
elseif (checkIfUserIDExists($cleanUserID) == TRUE) {
	echo '<script type="text/javascript">alert("ERROR: User ID already Exists"); </script>';
	return false;
}

if ($the_password != $confirm_password) {
	echo '<script type="text/javascript">alert("ERROR: Passwords Dont Match"); </script>';
	return false;
}
$cleanPassword = cleaninput($the_password);
if (strlen($cleanPassword) < 6){
	echo '<script type="text/javascript">alert("ERROR: Password length is too short."); </script>';
	return false;
}

$file = "fingerlog" . $the_fingerprint_code . ".txt";
	if(file_exists($file)) {
		$fingerprint_value = file_get_contents($file);
		unlink($file);
	}
	else {
		echo '<script type="text/javascript">alert("ERROR: Could Not find Fingerprint file"); </script>';
	return false;
	}

if ($the_active == "Active") {
	$the_active = 0;
}
else  {
	$the_active = 1;
}

addNewUser($cleanUserID, $cleanfName, $cleanlName, $cleanEmail, $the_UserRole, $cleanPassword, $fingerprint_value, $the_active);
}

?>
<?php include 'footer.php'; ?>
  </body>
</html>