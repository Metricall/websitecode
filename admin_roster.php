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
	include 'roster_functions.php';
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
	<center>
		<div class="form-style-heading">
		Search for a professor to do Rosters for:
		</div>
	</center>
	<?php include 'search_instructors.php'; ?>
	<center>
	<script src = "roster.js"></script>
		<?php
		if (isset($_POST["profchoice"])) {
			echo "Roster operations for professor: ";
			echo getUserFirstName($_POST["profchoice"])." ".getUserLastName($_POST["profchoice"])."<br><br>";
			echo "<button class=\"createButton\" id=\"creatRosId\" type=\"button\" onclick=\"newRosForm();\">Create Roster</button>";
		}
		?>
		<div class="form-style" id="newForm">
			<div class="form-style-heading">New Roster Information: </div>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<input type="hidden" name="profID" value="<?php if(isset($_POST["profchoice"])) {echo $_POST["profchoice"];} ?>">
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
		if(isset($_POST["profchoice"])) {
			echo "Existing Rosters:<br><br>";
			rosterlist($_POST["profchoice"]);
		}
		elseif(isset($_POST["rid"])) {
			rosterinfo($_POST["rid"]);
		}
		
		//course name needs sanitized before being used
		if (isset($_POST["defaultloc"])) {
			$returnedRID = newroster(cleaninput($_POST["coursename"]), $_POST["profID"], $_POST["defaultloc"]);
			if ($returnedRID > 0) {
				echo "New Roster Created<br><br>";
				rosterinfo($returnedRID);
				echo "<br>";
				echo "put stuff here to go to adding students.";
			}
			elseif ($returnedRID == false)
				echo "Failed to create roster.";
		}
		?>
		</table>
	</center>
	<?php include 'footer.php'; ?>
  </body>
</html>