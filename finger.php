<html>
<head>
<title>Metrical Fingerprint</title>
</head>
<?php $Identity = $_REQUEST['Identity'] ; $Location = $_REQUEST['Location'] ; ?>

<?php
include 'DatabaseUtilities.php';

//returns sessionID of session at location that is current happening
//or returns -1 if there is no current session
function findsession($loc) {
	//trying to find current session, start as false
	$CurrentSession = false;

	//get session list for location from database and make into array
	$SessionString = getSessionListByLoc($loc);
	if ($SessionString == false)	//if no sessions at that location
		return -1;
	$SessionList = explode(',', $SessionString);
	
	//check date and times to see if it is current session
	date_default_timezone_set("America/Los_Angeles");
	foreach ($SessionList as $ThisSession) {
		//check if current date is same as date of the session
		if (getSessionDate($ThisSession) == date("Y-m-d")) {
			//check current time to be in range of start/end of session
			if ( date("H:i:s") >= getSessionStart($ThisSession) AND date("H:i:s") <= getSessionEnd($ThisSession)) {
				$CurrentSession = $ThisSession;
				break;	//exit foreach loop if found
			}
		}
	}
	
	//if $CurrentSession remains false, then no current session found, return -1
	if($CurrentSession == false)
		return false;
	else	//otherwise return found session ID
		return $CurrentSession;	
}

//see if biometric identity matches any user for that roster
//if does, record user as attended and return true
//otherwise return false
function matchuser($id, $sid) {
	//obtain student list for roster that this session is part of and make into array
	$StudentString = getRosterStudentList(getSessionRosterID($sid));
	if ($StudentString == false)	//if no users, then no match possible
		return false;
	$StudentList = explode(',', $StudentString);
	
	//check current $id against stored ids of each student
	foreach ($StudentList as $ThisStudent) {
		//if match found, then add student to 'attended' for this session
		if($id == getUserBiometric($ThisStudent)) {
			//obtain attended and make into array
			$AttendedString = getSessionAttended($sid);
			//add student to attended (but check if already attended)
			if (strlen($AttendedString) == 0) {
				$AttendedList[] = $ThisStudent;
			}
			else {
				$AttendedList = explode(',', $AttendedString);
				foreach ($AttendedList as $Attended) {
					//if student already attended, return true
					//(so will repeat display that they are checked in)
					if ($Attended == $ThisStudent)
						return true;
				}
				//add user to attended if they did not already attend
				$AttendedList[] = $ThisStudent;
				sort($AttendedList);
			}
			
			//construct new string with current student added
			$AttendedString = implode(',', $AttendedList);
			//replace attended for this session with new string containing this student
			$setsuccess = setSessionAttended($sid, $AttendedString);
			return $setsuccess;	//in case set to DB fails
		}
	}
	return false;	//default to no match if reached here
}

//if biometric unit not at admin location, try to check user in for attendance
//return true if student recorded as attended, false otherwise
function checkin($id, $loc) {
	//obtain sessionID of current session
	$sid = findsession($loc);
	
	//if no current session, return false
	if($sid < 0)
		return false;
	//if there is a current session, try to match $id against list of students for that session
	else {
		return matchuser($id, $sid);
	}
}

//produce file that stores read-in biometric identity for account creation
//returns file code (or -1 if could not create file)
function biometricfile($id) {
	//produce random file code
	$Name = rand(100,999);
	$Attempts = 0;
	//find a filename that doesn't exist
	while (file_exists("fingerlog" . $Name . ".txt") AND ++$Attempts < 1000)
		$Name = rand(100,999);
	
	//if available file found, create file
	if ($Attempts < 1000)
	{
		//create file for writing
		$newID = fopen("fingerlog" . $Name . ".txt", "w");
		//wrtie $Identity into file
		fwrite($newID, $id);
		//close file
		fclose($newID);
		//postcondition assumption: account creation will consume and delete file
		return $Name;
	}
	else
		return -1;
}
?>

<body bgcolor="#FFFFFF" text="#000000">
<center>
<br><br><br>
<font size="500%" face="verdana" color="white">
<?php 
//check if using admin location
if ($Location == "admin") {	
	//attempt to write biometric info to file
	$code = biometricfile($Identity);
	
	//if file not created, display failure message
	if ($code < 0)
	{
		echo "<body style='background-color:red'>";
		print "<br><br>ERROR storing biometric identity information.";
		print "<br>(Try again or try using cleaning utility to clear old files.)";
	}
	//display file code for use for account creation
	else
	{
		echo "<body style='background-color:blue'>";
		print "<br><br>Account Creation Biometric Information stored.\r";
		print "<br>Remember Your Code: " . $code;
	}
}
//if not at admin location, attempt attendance checkin
elseif (checkin($Identity, $Location)) {
	echo "<body style='background-color:green'>";
	print "Attended!";
	header ("refresh:3; url=findex.php");
}
//not admin location and attendance not recorded
else {
	echo "<body style='background-color:red'>";
	print "Attendance checkin failed.";
	header ("refresh:3; url=findex.php");
}
?>
</font>
<br><br><br><br><br><br><br>
<?php
//administrative info, DISABLE FOR RELEASE
print "i: " . $Identity . " | l: " . $Location;
?>
</center>
<p>
</body>
</html>