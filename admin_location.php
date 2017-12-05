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
<?php
function newlocation($id,$room,$building,$lock) {
	//initial validate $id
	$vid = filter_var($id, FILTER_VALIDATE_INT);
	if(strlen($id) > 20 OR $vid === false) {
		echo '<script type="text/javascript">alert("ERROR: Invalid Location ID format."); </script>';
		return false;
	}
	//initial validate $room
	$vroom = filter_var($room, FILTER_VALIDATE_INT);
	if(strlen($room) > 11 OR $vroom === false) {
		echo '<script type="text/javascript">alert("ERROR: Invalid Room Number format."); </script>';
		return false;
	}
	//initial validate $building
	$vbuilding = cleaninput($building);
	if(strlen($vbuilding) > 16 OR strlen($vbuilding) < 1) {
		echo '<script type="text/javascript">alert("ERROR: Building Name must be 1-16 characters."); </script>';
		return false;
	}
	//check if $id or $building/$room already in database
	$locations = explode(',', getLocationList());
	foreach($locations as $l) {
		if ($l == $id) {
			echo '<script type="text/javascript">alert("ERROR: That Location ID already used. Try a different one."); </script>';
			return false;
		}
		elseif ($vbuilding." ".$vroom == getLocationBuilding($l)." ".getLocationRoom($l)) {
			echo "<script type=\"text/javascript\">alert(\"ERROR: $vbuilding $vroom already in database. \"); </script>";
			return false;
		}
	}
	
	$setsuccess = addNewLocation($id,$room,$building,$lock);
	if($setsuccess)
		return $vid;
	else
		return false;
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
	<br>
	<center>
		<div class="form-style-heading">
		Find a Locations ID:
		</div>
	</center>
	<?php include 'search_location.php'; ?>
	<br><br>
	<script src = "roster.js"></script>
	<center>
		<button class="createButton" id="creatRosId" type="button" onclick="newRosForm();">
			Create Location</button>
		<div class="form-style" id="newForm">
			<div class="form-style-heading">Location Information: </div>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<label><span>Location ID: </span><input type="text" class="input-field" name="loc"  /></label>
				<label><span>Room Number: </span><input type="text" class="input-field" name="room" /></label>
				<label><span>Building: </span><input type="text" class="input-field" name="bldg"  /></label>
				<label><span>Locked: </span><select type="text" class="select-field" name="lock" >				
					<option value="0">Unlock</option>
					<option value="1">Locked</option>
				</select></label>
				<label><span>&nbsp;</span><input type="submit" value="Submit"></label>
			</form>
		</div>
	</center><br>
	<center>
		<table id="infoTable" class="infoTable">
		<?php
			if(isset($_POST["loc"])) {
				$newLoc = newlocation($_POST["loc"],$_POST["room"],$_POST["bldg"],$_POST["lock"]);
				if($newLoc === false)
					echo "Failed to create a new location.";
				else
					echo "New Location created.";
			}
		?>
		<br><br><br>
		<a href="/f/MetricalFingerprint.jar">Download Fingerprint Scanner Emulator here.</a>
		</table>
	</center>
	<?php include 'footer.php'; ?>
  </body>
</html>