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
  
<form action="getUserEmail.php" method="get" enctype="application/x-www-form-urlencoded">
<p>Enter User ID: <input type="text" name="uid" size="20"" />
&nbsp;&nbsp;
<input type="submit" value="Calculate" />
</form>
<br><br><br><br>
<font size="500%" face="verdana">
<?php

if (isset($_GET['uid'])) {
	showGet();
}

function showGet() {
	include 'DatabaseUtilities.php';
	$user = $_GET['uid'];
	$thevalue = getUserEmail($user);
	print $thevalue;
}
?>
</font>
  </body>
</html>



