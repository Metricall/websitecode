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
if ($Location == "admin") {
	//produce file that stores $Identity for account creation
	$Name = rand(100,999);
	$Attempts = 0;
	//find a filename that doesn't exist
	while (file_exists("fingerlog" . $Name . ".txt") AND ++$Attempts < 1000)
		$Name = rand(100,999);
	
	if ($Attempts < 1000)
	{
		//attempt create file for writing
		$newID = fopen("fingerlog" . $Name . ".txt", "w");
		//wrtie $Identity into file
		fwrite($newID, $Identity);
		//display filename for use for account creation
		echo "<body style='background-color:blue'>";
		print "<br><br>Biometric identity information stored for Account Creation.\r";
		print "<br><br>Code: " . $Name;
		//close file and mark successful save so loop stops
		fclose($newID);
		//assume that account creation will consume and delete file
	}
	else
	{
		echo "<body style='background-color:red'>";
		print "<br><br>ERROR storing biometric identity information.";
		print "<br>Try cleaning utility to clear old files.";
	}
} elseif (true /* checkin($Identity, $Location) */) {
	echo "<body style='background-color:green'>";
	print "You are marked as attended.";
} else {
	echo "<body style='background-color:red'>";
	print "Attendance checkin failed.";
}
?>
<center>
<p>
</body>
</html>
