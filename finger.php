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
	$saved = false;
	$Name = rand();
	while (!$saved)
	{
		//attempt create file for writing
		$newID = fopen("newfinger\\" + $Name + ".txt", x);
		if (!$newID)	//successful new file
		{
			//wrtie $Identity into file
			fwrite($newID, $Identity);
			//display filename for use for account creation
			echo "<body style='background-color:blue'>";
			print "Print stored for Account Creation.\r";
			print "Code: " + $Name;
			//close file and mark successful save so loop stops
			fclose($newID);
			$saved = true;
		}
		else	//tried to create using file name that already exists
		{
			//setup new name for reattempt in next loop
			$Name = rand();
		}
	} //assume that account creation will consume and delete file
} elseif (/* checkin($Identity, $Location) */) {
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
