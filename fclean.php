<html>
<head>
</head>

<body bgcolor="#FFFFFF" text="#000000">
<center>
<br><br><br>
<p>

<?php 
echo "Will delete all fingerprint files.<br>";
echo "All in progess account creations will need new scans.<br><br><br>";

$DirName = ".";
if(file_exists($DirName))
{
	$DirEntries = scandir($DirName);
	foreach($DirEntries as $Entry)
	{
		echo $Entry;
		if(stripos($Entry, "ingerlog") == 1)
		{
			echo " (yes)";
			if (unlink($Entry))
				echo " deleted <br>";
			else
				echo " not deleted<br>";
		}
		else
			echo " (no) <br>";
	}
}

?>
<center>
<p>
</body>
</html>