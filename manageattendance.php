<?php
session_start();
?>
<?php
	include 'DatabaseUtilities.php';
	include 'LoginUtilities.php';
	if (checkLogin()) {
		//not an admin or insturctor
		if ($_SESSION["role"] != "Admin" AND $_SESSION["role"] != "Professor")
			header("Location: logout.php");
		//no roster chosen
		elseif (!isset($_SESSION["rid"]))
			header("Location: professormain.php");
	}
	$pagetype = "Professor";
	include 'session_functions.php';
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
	<center>
	<?php 				
		if(isset($_GET["act"])) {
			if($_GET["act"] == "clearsession") {
				unset($_SESSION["sid"]);
				header("Location: ".htmlspecialchars($_SERVER["PHP_SELF"])); 
			}
		}
		if(isset($_POST["sid"])) {
			$_SESSION["sid"] = $_POST["sid"];
		}
		
		if(!isset($_SESSION["sid"])) {
			echo "
				<div class = 'row' id = 'yourclasses'>
				<div class = 'col-xs-12' align='center'><h2>Session List</h2></div>
				</div><br>
				";
			sessionlist($_SESSION["rid"], true);
		}
		
		if(isset($_POST["markabsent"])) {
			if(removestudent($_SESSION["sid"], $_POST["markabsent"]))
				echo "<script type='text/javascript'>alert('User marked absent.');</script>";
			else
				echo "<script type='text/javascript'>alert('Error: unable to mark user absent.');</script>";
		}
		if(isset($_POST["markattended"])) {
			if(addstudent($_SESSION["sid"], $_POST["markattended"]))
				echo "<script type='text/javascript'>alert('User marked attended.');</script>";
			else
				echo "<script type='text/javascript'>alert('Error: unable to mark user attended.');</script>";
		}

		if(isset($_SESSION["sid"])) {
			echo "
				<div class = 'row' id = 'yourclasses'>
				<div class = 'col-xs-12' align='center'><h2>Session Attendance</h2></div>
				</div><br>
				";
			echo getSessionDate($_SESSION["sid"])."<br>";
			echo getSessionStart($_SESSION["sid"])." to ".getSessionEnd($_SESSION["sid"]);
			echo "<br><br><a href=\"".htmlspecialchars($_SERVER["PHP_SELF"])."?act=clearsession\">Click here when done.</a>";
			echo "<br><br> Student List:<br><br>";
			showstudentlist($_SESSION["sid"], true);
		}
	?>
	</center>
	<?php include 'footer.php'; ?>
  </body>
</html>