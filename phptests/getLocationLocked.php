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
  
<form action="getLocationLocked.php" method="get" enctype="application/x-www-form-urlencoded">
<p>Enter Location ID: <input type="text" name="lid" size="20"" />
&nbsp;&nbsp;
<input type="submit" value="Calculate" />
</form>
<br><br><br><br>
<font size="500%" face="verdana">
<?php

if (isset($_GET['lid'])) {
	showGet();
}

function showGet() {
	include 'DatabaseUtilities.php';
	$loc = $_GET['lid'];
	$thevalue = getLocationLocked($loc);
	print $thevalue;
}
?>
</font>
  </body>
</html>



