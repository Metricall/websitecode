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
			<Form name ="addUser" Method ="Post" Action ="admin_user.php?func_name=validateInputForAddingUser">
				<label><span>User ID: </span><input type="text" class="input-field" id="userID" value="" /></label>
				<label><span>First Name: </span><input type="text" class="input-field" id="first" value="" /></label>
				<label><span>Last Name: </span><input type="text" class="input-field" id="last" value="" /></label>
				<label><span>Role: </span>
				<select name="rolesearch" class="input-field">
				<option value="anyuser">Professor</option>
				<option value="number">Administrator</option>
				<option value="number">Student</option>
			    </select></label>
				<label><span>Password: </span><input type="Password" class="input-field" id="password1" value="" /></label>
				<label><span>Confirm Password: </span><input type="Password" class="input-field" id="password2" value="" /></label>
				<!--admin

				<script type="text/javascript">
					//	function Validate() {
					//		var confirmPassword1 = document.getElementById("password1").value;
					//		var confirmPassword2 = document.getElementById("password2").value;
					//		if (confirmPassword1 != confirmPassword2) {
					//			alert("Passwords do not match.");
					//			return false;
					//		}
					//		return true;
						//}
				//</script>
				 -->
				<label><span>Email: </span><input type="text" class="input-field" id="email" value="" /></label>
				<label><span>FingerPrint File #: </span><input type="text" class="input-field" id="finger" value="" /></label>
				<label><span>Active: </span><select type="text" class="select-field" id="active" value="" />
					<option value="act">Active</option>
					<option value="inAct">Inactive</option>
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
include 'DatabaseUtilities.php';
$the_UserID = $_POST['userID'];
$the_fName = $_POST['first'];
$the_lName = $_POST['last'];
$the_UserRole = $_POST['rolesearch'];
$the_password = $_POST['password1'];
$the_email = $_POST['email'];
$the_active = $_POST['active'];
$the_fingerprint = $_POST['finger'];
//if (the_active == Active) {
$the_UserRole = "Student";
$the_active = "0";
//}
//else $the_active = 1;
addNewUser($the_UserID, $the_fName, $the_lName, $the_email, $the_UserRole, $the_password, $the_fingerprint, $the_active);
}
?>
<?php include 'footer.php'; ?>
  </body>
</html>
