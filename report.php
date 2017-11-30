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
	<div class = 'row' id = 'yourclasses'>
	<div class = 'col-xs-5'></div>
	<div class = 'col-xs-7'><h2>Generate Report</h2></div>
	</div><br>
	
	<div class = 'row' id = 'firstform'>
	<div class = 'col-xs-3'></div>
	<div class = 'col-xs-2'> Report Name </div>
	<div class = 'col-xs-1'><input type = 'text' id = 'box'></div>
	</div><br>
	<div class = 'row' id = 'lastform'>
	<div class = 'col-xs-3'></div>
	<div class = 'col-xs-2'> From Date </div>
	<div class = 'col-xs-1'><input type = 'text' id = 'box'></div>
	</div><br>
	<div class = 'row' id = 'emailform'>
	<div class = 'col-xs-3'></div>
	<div class = 'col-xs-2'> To Date </div>
	<div class = 'col-xs-1'><input type = 'text' id = 'box'></div>
	</div><br>
	<div class = 'row' id = 'sendbutton'>
	<div class = 'col-xs-5'></div>
	<div class = 'col-xs-3'><input type = 'submit' id = 'submitform' value = 'Create'></div>
	</div><br><br><br>
	
	<table border="1" id = 'roster'>
  <tr>
    <th id = 'color11'>Report ID</th>
    <th id = 'color22'>Report Name</th>
	<th id = 'color11'>From Date</th>
    <th id = 'color22'>To Date</th>
  </tr>
  <tr>
	<td id = 'color11'>11111</td>
	<td id = 'color22'>Test # 1</td>
	<td id = 'color11'>March 21, 2018</td>
		<td id = 'color11'>June 21, 2018</td>

</table>
	<?php include 'footer.php'; ?>
  </body>
</html>