<?php
session_start();
?>
<?php
	include 'LoginUtilities.php';
	if (checkLogin()) {
		//not an admin or insturctor
		if ($_SESSION["role"] != "Admin" AND $_SESSION["role"] != "Professor")
			header("Location: logout.php");
		//if it's an admin but has not chosen a professor
		elseif($_SESSION["role"] == "Admin" AND !isset($_SESSION["instructorID"]))
			header("Location: adminmain.php");
		//professor user id is assigned as instructor id
		elseif ($_SESSION["role"] == "Professor")
			$_SESSION["instructorID"] = $_SESSION["uid"];
	}
?>
<?php
	include 'DatabaseUtilities.php';
	$fn = getUserFirstName($_SESSION["instructorID"]);
	$ln = getUserLastName($_SESSION["instructorID"]);
	$_SESSION["instructorName"] =  "{$fn} {$ln}";
	
	if(isset($_REQUEST["rid"])) {
		$_SESSION["rid"] = $_REQUEST["rid"];
		header("Location: professorclass.php");
	}
	
	function rosterlist(){
		$classlist = getRosterListByInstructor($_SESSION["instructorID"]);
		if (strlen($classlist) == 0) {
			echo "You do not have any classes available.  If you believe this to be an error, please contact an administrator.";
		}
		else {
			$classes = explode(',', $classlist);
			echo "<form action='professormain.php' method='post'>";
			foreach($classes as $aClass)
			{
				echo "<div class = 'col-xs-12'><button type='submit' value='";
				echo $aClass;
				echo "' name='rid'>";
				echo getRosterCourseName($aClass);
				echo "</button> </div><br><br>";
			}
			echo "</form>";
		}
	}
?>
<!DOCTYPE html>
<!--professor
 -->
<html lang = "en">
  <head>
   <link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css">
    <link rel = "stylesheet" type = "text/css" href = "mainmetrical.css">
    <title> Professor </title>
    <meta charset = "utf-8">
  </head>
  <body>
	<?php include 'header.php'; ?>
	<br>
	<?php if ($_SESSION["role"] == "Admin"){include 'adminwelcome.php';echo "<br>";} ?>
	<?php include 'instructorwelcome.php'; ?>
	<br>
	<div class = 'row' id = 'yourclasses'>
	<div class = 'col-xs-12' align="center">
	<h2>Your Classes</h2>
	<h3>
	<?php rosterlist(); ?>
	<br><br>
	</h3>
	</div>
	</div>
	<?php include 'footer.php'; ?>
</html>