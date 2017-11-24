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
	
	if(isset($_POST["chosen"])) {
		$_SESSION["instructorID"] = $_POST["chosen"];
		header("Location: professormain.php");
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
				echo "' name='chosen'>Go!</button><br>";
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
    <title> Admin-Sessions </title>
    <meta charset = "utf-8">
  </head>
  <body>
	<?php include 'header.php'; ?>
	<br>
	<?php include 'adminwelcome.php'; ?>
	<br>
	<?php include 'adminmenu.php'; ?>
	<br>
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
		<div class="form-style-heading">
		<?php
			if(!isset($_POST["searchvalue"])) {
				echo "Search for a professor to do Sessions and Reports for.";
			}
		?>
		</div>
	</center><br>
	<center>
		<table id="infoTable" class="infoTable">
		<?php
			if(isset($_POST["searchvalue"])) {
				instructorlist();
			}
		?>
			
		</table>
	</center>
	<?php include 'footer.php'; ?>
  </body>
</html>