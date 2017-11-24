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
	
	function instructorlist(){
		//by name, get userIDs -> make array. by number, make array with that number
		$usersearchinput = cleaninput($_POST["searchvalue"]);
		if ($_POST["typeofsearch"] == "professor") {
			$ulist = getUserIDsByName($usersearchinput);
			$ulist = explode(',', $ulist);
		}
		elseif ($_POST["typeofsearch"] == "number") {
			$ulist[] = $usersearchinput;
		}
		//if potential user is professor and not locked, add to instructor list
		foreach($ulist as $u) {
			if(getUserRole($u) == "Professor" AND getUserLocked($u) == 0)
				$instructors[] = $u;
		}
		//display instructor list and allow admin to choose (usually only will be 1 choice though)
		if (count($instructors) == 0) {
			echo "No professors found with that name or ID.";
		}
		else {
			echo "<form action='";
			echo htmlspecialchars($_SERVER["PHP_SELF"]);
			echo "' method='post'>";
			foreach($instructors as $aInstructor)
			{
				echo getUserFirstName($aInstructor) . " " . getUserLastName($aInstructor);
				echo " (" . getUserEmail($aInstructor). ") &nbsp;";
				echo "<button type='submit' value='";
				echo $aInstructor;
				echo "' name='profchosen'>Go!</button><br>";
			}
			echo "</form>";
		}
	}

	function rosterlist(){
		$classlist = getRosterListByInstructor($_POST["profchosen"]);
		if (strlen($classlist) == 0) {
			echo "Professor has no rosters yet.";
		}
		else {
			$classes = explode(',', $classlist);
			echo "<form action='";
			echo htmlspecialchars($_SERVER["PHP_SELF"]);
			echo "' method='post'>";
			foreach($classes as $aClass)
			{
				echo "<button type='submit' value='";
				echo $aClass;
				echo "' name='rid'>";
				echo getRosterCourseName($aClass);
				echo "</button><br><br>";
			}
			echo "</form>";
		}
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
	<?php include 'adminwelcome.php'; ?>
	<br>
	<?php include 'adminmenu.php'; ?>
	<br>
	<script src = "roster.js"></script>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<center>Search:
 			<select name="typeofsearch">
				<option value="professor">Professor</option>
				<option value="number">User ID</option>
			</select>
			<input type="text" name="searchvalue">
			<input type="submit" value="Search" />
		</center><br>
	</form>
	<center>
		<?php
		if (isset($_POST["profchosen"])) {
			echo "Roster operations for professor: ";
			echo getUserFirstName($_POST["profchosen"])." ".getUserLastName($_POST["profchosen"])."<br><br>";
			echo "<button class=\"createButton\" id=\"creatRosId\" type=\"button\" onclick=\"newRosForm();\">Create Roster</button>";
		}
		?>
		<div class="form-style" id="newForm">
			<div class="form-style-heading">New Roster Information: </div>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<input type="hidden" name="profID" value="<?php echo $_POST["profchosen"]; ?>">
				<label><span>Course Name: </span><input type="text" name="coursename"></label>
				<label><span>Default Location: </span>
				<select name="defaultloc">
				<?php
					$locations=getLocationList();
					$locations=explode(',',$locations);
					foreach($locations as $l) {
						echo "<option value='".$l."'>";
						echo getLocationBuilding($l)." ".getLocationRoom($l);
						echo"</option>";
					}
				?>
				</select></label>
				<label><span>&nbsp;</span><input type="submit" value="Submit"></label>
			</form>
		</div>
	</center><br>
	<center>
		<table id="infoTable" class="infoTable">
		<?php
		if(isset($_POST["searchvalue"])) {
			instructorlist();
		}
		elseif(isset($_POST["profchosen"])) {
			echo "Professor has existing Rosters:<br><br>";
			rosterlist();
		}
		elseif(isset($_POST["rid"])) {
			echo getRosterCourseName($_POST["rid"]) . "<br>";
			echo getRosterStudentList($_POST["rid"]) . "<br>";
			echo getRosterInstructor($_POST["rid"]) . "<br>";
			echo getRosterLocation($_POST["rid"]) . "<br>";
		}
		
		//course name needs sanitized before being used
		if (isset($_POST["coursename"]))
			var_dump($_POST["coursename"]);
		echo "<br>";
		if (isset($_POST["profID"]))
			var_dump($_POST["profID"]);
		echo "<br>";
		if (isset($_POST["defaultloc"]))
			var_dump($_POST["defaultloc"]);
		echo "<br>";
		?>
		</table>
	</center>
	<?php include 'footer.php'; ?>
  </body>
</html>