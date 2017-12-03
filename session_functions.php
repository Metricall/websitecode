<?php
	//generate session list for given roster
	//$modify is true, then show modify button
	function sessionlist($the_roster, $modify){
		$sessionlist = getSessionListByRoster($the_roster);
		//only generate if there are sessions to show
		if (strlen($sessionlist) == 0) {
			echo "This class does not have any sessions.  Try creating some.";
		}
		else {
			echo "
			<table border='1' id = 'roster'>
			  <tr>
				<th id = 'color11'>Date</th>
				<th id = 'color22'>Start</th>
				<th id = 'color22'>End</th>
				<th id = 'color11'>Location</th>
			";
			if($modify)
				echo "<th id = 'color11'>&nbsp;</th>";
			echo "</tr>";
			$sessions = explode(',', $sessionlist);
			echo "<form action='";
			echo htmlspecialchars($_SERVER["PHP_SELF"]);
			echo "' method='post'>";
			foreach($sessions as $aSession)
			{
				echo "<tr><td id = 'color11'>";
				echo date("n/j/Y", strtotime(getSessionDate($aSession)));
				echo "</td><td id = 'color22'>";
				echo date("g:i A", strtotime(getSessionStart($aSession)));
				echo "</td><td id = 'color22'>";
				echo date("g:i A", strtotime(getSessionEnd($aSession)));
				echo "</td><td id = 'color11'>";
				echo getLocationBuilding(getSessionLocationID($aSession));
				echo " ";
				echo getLocationRoom(getSessionLocationID($aSession));				
				echo "</td>";
				if($modify){
					echo "<td id = 'color11'>";
					echo "<button type='submit' value='";
					echo $aSession;
					echo "' name='sid'>Modify</button></td>";
				}
				echo "</tr>";
			}
			echo "</form></table>";
		}
	}
	
	//adds session to database
	//generates a unique ID for it based on time, returns that ID
	function newsession($roster, $location, $date, $start, $end){
		$newSID = date("YmdHis");
		//set default time zone
		date_default_timezone_set("America/Los_Angeles");
		//date validation
		if (($vDate = strtotime($date)) === false){
			$message = "Error: ($date) is not a valid Date.";
			echo "<script type='text/javascript'>alert('$message');</script>";
			return false;
		}
		if (($vStart = strtotime($start)) === false){
			$message = "Error: ($start) is not a valid Start Time.";
			echo "<script type='text/javascript'>alert('$message');</script>";
			return false;
		}
		if (($vEnd = strtotime($end)) === false){
			$message = "Error: ($end) is not a valid End Time.";
			echo "<script type='text/javascript'>alert('$message');</script>";
			return false;
		}
		//check end time is not before start time
		if ($vStart >= $vEnd){
			$message = "Error: End Time ($end) must be after Start Time ($start).";
			echo "<script type='text/javascript'>alert('$message');</script>";
			return false;
		}
		//convert date/time to database stored format
		$vDate = date("Y-m-d", $vDate);
		$vStart = date("H:i:s", $vStart);
		$vEnd = date("H:i:s", $vEnd);
		//check no overlap with sessions at the same location
		$existingsessions = getSessionListByLoc($location);
		if ($existingsessions != false){
			$SessionList = explode(',', $existingsessions);
			foreach ($SessionList as $ThisSession) {
				if (getSessionDate($ThisSession) == $vDate) {
					$sStart = getSessionStart($ThisSession);
					$sEnd = getSessionEnd($ThisSession);
					//if intended start or end time is within any existing session there is overlap
					if ( $vStart >= $sStart AND $vStart <= $sEnd) {
						$message = "Error: There is already a session at that time for that location.";
						echo "<script type='text/javascript'>alert('$message');</script>";
						return false;
					}
					if ( $vEnd >= $sStart AND $vEnd <= $sEnd) {
						$message = "Error: There is already a session at that time for that location.";
						echo "<script type='text/javascript'>alert('$message');</script>";
						return false;
					}
				}
			}
		}
		//attempt make new session
		if(addNewSession($newSID, $roster, $location, $vDate, $vStart, $vEnd))
			return $newSID;
		else
			return false;
	}
	
	//add user with given userID to session attendance
	function addstudent($the_session, $the_user) {
		$attendlist = getSessionAttended($the_session);
		//first person to attend, just add
		if (strlen($attendlist) == 0) {
			$attendarr[] = $the_user;
		}
		//session attendance not empty, check if user is already attended first
		else {
			$attendarr = explode(',', $attendlist);
			foreach ($attendarr as $aStudent) {
				if ($aStudent == $the_user)
					return false;
			}
			$attendarr[] = $the_user;
			sort($attendarr);
		}
		//construct new string with current student added
		$attendlist = implode(',', $attendarr);
		//replace attended for this session with new string containing this student
		$setsuccess = setSessionAttended($the_session, $attendlist);
		return $setsuccess;
	}
	
	//remove user with given userID from session attendance
	function removestudent($the_session, $the_user) {
		$attendlist = getSessionAttended($the_session);
		$attendarr = explode(',', $attendlist);
		//search for user in session attendance, remove if found
		if (($key = array_search($the_user, $attendarr)) !== false) {
			unset($attendarr[$key]);
		}
		$attendlist = implode(',', $attendarr);
		$setsuccess = setSessionAttended($the_session, $attendlist);
		return $setsuccess;
	}
	
	//display student list with attendance for session
	//$attend_change is true, then show buttons to allow attendance changing
	function showstudentlist($the_session, $attend_change){
		//get full list of students in roster that session is part of
		$rosterlist = getRosterStudentList(getSessionRosterID($the_session));
		//if roster has no students, then nothing to show
		if (strlen($rosterlist) == 0) {
			echo "Roster has no students.";
		}
		else {
			//get session attendance (make roster students, and attended students into arrays)
			$students = explode(',', $rosterlist);
			$attendlist = getSessionAttended($the_session);
			$attendarr = explode(',', $attendlist);
			
			echo "<form action='";
			echo htmlspecialchars($_SERVER["PHP_SELF"]);
			echo "' method='post'>";
			//for each student in the roster
			foreach($students as $aStudent)
			{
				echo getUserFirstName($aStudent) . " " . getUserLastName($aStudent);
				echo " (" . getUserEmail($aStudent). ") &nbsp;";
				//check if student is in the attendance list
				//show attendance status (and change status button if appropriate)
				if (($found = array_search($aStudent, $attendarr)) !== false) {
					echo "Status: Attended &nbsp;";
					if($attend_change) {
						echo "<button type='submit' value='";
						echo $aStudent;
						echo "' name='markabsent'>Mark Absent</button>";
					}
				}
				else {
					echo "Status: Absent &nbsp;";
					if($attend_change) {
						echo "<button type='submit' value='";
						echo $aStudent;
						echo "' name='markattended'>Mark Attended</button>";
					}
				}
				echo "<br><br>";
			}
			echo "</form>";
		}
	}

?>