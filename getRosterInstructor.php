<!DOCTYPE html>
<!--Metrical Main Site
 -->
<html lang = "en">
 <head>
    <link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css">
	<link rel = "stylesheet" type = "text/css" href = "mainmetrical.css">
    <title> Metrical </title>
    <meta charset = "utf-8">
 </head>
<body>
  
<form action="getRosterInstructor.php" method="get" enctype="application/x-www-form-urlencoded">
<p>Enter Roster ID: <input type="text" name="rid" size="20"" />
&nbsp;&nbsp;
<input type="submit" value="Calculate" />
</form>
<br><br><br><br>
<font size="500%" face="verdana">
<?php

if (isset($_GET['rid'])) {
	showGet();
}

function showGet() {
	include 'DatabaseUtilities.php';
	$roster = $_GET['rid'];
	$thevalue = getRosterInstructor($roster);
	print $thevalue;
}
?>
</font>
  </body>
</html>



