<html>
<head>
<title>Metrical Fingerprint</title>
</head>
<?php $Identity = $_REQUEST['Identity'] ; $Location = $_REQUEST['Location'] ; ?>

<?php
function checkin($id, $loc) {
	include 'SimDatabaseUtilities.php';
	//trying to find current session, start as false
	$CurrentSession = false;

	//get session list for location from database and make into array
	$SessionString = getSessionListByLoc($loc);
	if ($SessionString == false)
		return false;
	$SessionList = explode(',', $SessionString);
	
	//check date and times to see if it is current session
	date_default_timezone_set("America/Los_Angeles");
	foreach ($SessionList as $ThisSession) {
		if (getSessionDate($ThisSession) == date("Y-m-d")) {
			//assuming we're using 24h format in Pacific Time Zone
			if ( date("H:i:s") >= getSessionStart($ThisSession) AND date("H:i:s") <= getSessionEnd($ThisSession)) {
				$CurrentSession = $ThisSession;
				break;
			}
		}
	}
	
	//if $CurrentSession remains false, then no current session found, return false
	if($CurrentSession == false)
		return false;
	//if there is a $CurrentSession, try to match $id against list of students for that session
	else {
		//obtain student list for roster that this session is part of and make into array
		$StudentString = getStudentList(getSessionRosterID($CurrentSession));
		if ($StudentString == false)
			return false;
		$StudentList = explode(',', $StudentString);
		
		//check current $id against stored ids of each student
		foreach ($StudentList as $ThisStudent) {
			//if match found, then add student to 'attended' for this session
			if($id == getUserBiometric($ThisStudent)) {
				//obtain attended and make into array
				$AttendedString = getSessionAttended($CurrentSession);
				//add student to attended (but check if already attended)
				if (strlen($AttendedString) == 0) {
					$AttendedList[] = $ThisStudent;
				}
				else {
					$AttendedList = explode(',', $AttendedString);
					$AlreadyAttended = false;
					foreach ($AttendedList as $Attended) {
						if ($Attended == $ThisStudent)
							$AlreadyAttended = true;
					}
					if (!$AlreadyAttended)
						$AttendedList[] = $ThisStudent;
					sort($AttendedList);
				}
				
				//construct new string with current student added
				$AttendedString = implode(',', $AttendedList);
				//replace attended for this session with new string containing this student
				setSessionAttended($CurrentSession, $AttendedString);
				return true;
			}
		}
		return false;
	}
}
?>

<body bgcolor="#FFFFFF" text="#000000">
<center>
<br><br><br>
<font size="500%" face="verdana" color="white">
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
		print "<br><br>Account Creation Biometric Information stored.\r";
		print "<br>Remember Your Code: " . $Name;
		//close file and mark successful save so loop stops
		fclose($newID);
		//assume that account creation will consume and delete file
	}
	else
	{
		echo "<body style='background-color:red'>";
		print "<br><br>ERROR storing biometric identity information.";
		print "<br>(Try again or try using cleaning utility to clear old files.)";
	}
} elseif (checkin($Identity, $Location)) {
	echo "<body style='background-color:green'>";
	print "Attended!";
	header ("refresh:3; url=findex.php");
} else {
	echo "<body style='background-color:red'>";
	print "Attendance checkin failed.";
	header ("refresh:3; url=findex.php");
}
?>
</font>
<br><br><br><br><br><br><br>
<?php print "i: " . $Identity . " | l: " . $Location; ?>
</center>
<p>
</body>
</html>