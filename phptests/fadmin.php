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
  
<form action="fadmin.php" method="get" enctype="application/x-www-form-urlencoded">
<p>Enter Code: <input type="text" name="code" size="10"" />
<p>
<input type="submit" value="Calculate" />
<input type="reset" value="Reset Form" />
</form>
<br><br><br><br>
<font size="500%" face="verdana">
<?php
if (isset($_GET['code'])) {
	$filecode = $_GET['code'];
	$file = "fingerlog" . $filecode . ".txt";
	if(file_exists($file)) {
		$id_value = file_get_contents($file);
		print $id_value;
		unlink($file);
	}
	else
		print "file not found";
}
?>
</font>
  </body>
</html>



