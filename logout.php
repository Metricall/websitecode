<?php
session_start();
?>
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
<font size="500%" face="verdana">
<?php
	session_unset();
	session_destroy();
	echo '<script>document.location.replace("/");</script>';
?>
</font>
  </body>
</html>



