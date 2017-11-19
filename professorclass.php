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
			header("Location: adminmain.html");
		//no roster chosen
		elseif (!isset($_SESSION["rid"]))
			header("Location: professormain.php");
	}
?>
<?php
	include 'DatabaseUtilities.php';
	
	function sayclass(){
		print getRosterCourseName($_SESSION["rid"]);
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
	<?php include 'instructorwelcome.php'; ?>
	<div class = 'row' id = 'yourclasses'>
	<div class = 'col-xs-12' align="center"><h2>Active Class: <?php	sayclass(); ?></h2>
	<br>
	</div>
	</div>
	<?php include 'instructormenu.php'; ?>
	<br>
	<div class = 'row' id = 'yourclasses'>
		<div class = 'col-xs-12' align="center"><h2>UI Team, I added this table since it's in your UI mock up, but what does this table do?  What are all the checkboxes supposed to be for?</h2></div>
	</div><br>
	<div class = 'row' id = 'yourclasses'>
		<div class = 'col-xs-5'></div>
		<div class = 'col-xs-7'><h2>Spring 2018</h2></div>
	</div><br>
	<table border="1" id = 'roster'>
	<tr>
		<th id = 'color11'>Name</th>
		<th id = 'color22'>StudentID</th>
		<th id = 'color33'>1/23</th>
		<th id = 'color44'>1/30</th>
		<th id = 'color33'>2/06</th>
		<th id = 'color44'>2/13</th>
		<th id = 'color33'>2/20</th>
		<th id = 'color44'>2/27</th>
		<th id = 'color33'>3/06</th>
		<th id = 'color44'>3/13</th>
		<th id = 'color33'>3/20</th>
		<th id = 'color44'>3/27</th>
		<th id = 'color33'>4/05</th>
		<th id = 'color44'>4/12</th>
	</tr>
	<tr>
		<td id = 'color11'>Matthew Affa</td>
		<td id = 'color22'>123456</td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent" ></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
	</tr>
	<tr>
		<td id = 'color11'>Crystele Dierickx</td>
		<td id = 'color22'>567890</td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent" ></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
	</tr>
	<tr>
		<td id = 'color11'>Victor Zavala</td>
		<td id = 'color22'>987654</td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent" ></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
		<td align = 'center'><input type="checkbox" disabled id="absent"></td>
	</tr>
	</table>
	<?php include 'footer.php'; ?>
</html>