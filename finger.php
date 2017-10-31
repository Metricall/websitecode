<html>
<head>
<title>Metrical Fingerprint Basic Test</title>
</head>
<?php $Identity = $_REQUEST['Identity'] ; $Location = $_REQUEST['Location'] ; ?>

<body bgcolor="#FFFFFF" text="#000000">
<center>
<br><br><br>
<p>
Identity data:&nbsp;
<?php print $Identity; ?>
<p>
From location:&nbsp;
<?php print $Location; ?>
<?php 
if ($Identity == "007") {
	echo "<body style='background-color:green'>";
} else {
	echo "<body style='background-color:red'>";
}
?>
<center>
<p>
</body>
</html>
