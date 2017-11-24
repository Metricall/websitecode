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
  
<form action="getRosterListByInstructor.php" method="get" enctype="application/x-www-form-urlencoded">
<p>Enter Instructor Name: <input type="text" name="iname" size="100"" />
&nbsp;&nbsp;
<input type="submit" value="Calculate" />
</form>
<br><br><br><br>
<font size="500%" face="verdana">
<?php

if (isset($_GET['iname'])) {
	showGet();
}

function showGet() {
	include 'DatabaseUtilities.php';
	$roster = $_GET['iname'];
	$thevalue = getRosterListByInstructor($roster);
	print $thevalue;
}
?>
</font>
  </body>
</html>



