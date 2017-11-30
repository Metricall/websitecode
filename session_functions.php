<?php	
	function sessionlist($the_roster, $modify){
		$sessionlist = getSessionListByRoster($the_roster);
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
				echo getSessionDate($aSession);
				echo "</td><td id = 'color22'>";
				echo getSessionStart($aSession);
				echo "</td><td id = 'color22'>";
				echo getSessionEnd($aSession);
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
	
/*	function rosterinfo($rostID, $edit_link) {
		$the_instrucID = getRosterInstructor($rostID);
		$the_locID = getRosterLocation($rostID);
		echo getRosterCourseName($rostID)."<br>";
		echo getUserFirstName($the_instrucID)." ".getUserLastName($the_instrucID)."<br>";
		echo getLocationBuilding($the_locID)." ".getLocationRoom($the_locID)."<br>";
		echo "<br>Student List: <br>";
		echo showstudentlist($rostID, false) . "<br>";
		if ($edit_link) {
			echo "<br>";
			echo "<a href=\"admin_roster_edit.php?roster=";
			echo $rostID;
			echo "\">Edit Roster</a><br>";
		}
	}
*/	

	function newsession($roster, $location, $date, $start, $end){
		$newSID = date("YmdHis");
		//set default time zone
		date_default_timezone_set("America/Los_Angeles");
		//date validation
		if (($vDate = strtotime($date)) === false){
			$message = "Error: ($date) not valid as Date.";
			echo "<script type='text/javascript'>alert('$message');</script>";
			return false;
		}
		if (($vStart = strtotime($start)) === false){
			$message = "Error: ($start) not valid as Start Time.";
			echo "<script type='text/javascript'>alert('$message');</script>";
			return false;
		}
		if (($vEnd = strtotime($end)) === false){
			$message = "Error: ($end) not valid as End Time.";
			echo "<script type='text/javascript'>alert('$message');</script>";
			return false;
		}
		//check end time is not before start time
		if ($vStart <= $vEnd){
			$message = "Error: End Time ($end) must be after Start Time ($start).";
			echo "<script type='text/javascript'>alert('$message');</script>";
			return false;
		}
		//check no overlap with sessions at the same location
		$existingsessions = getSessionListByLoc($location);
		if ($existingsessions != false){
			$SessionList = explode(',', $existingsessions);
			foreach ($SessionList as $ThisSession) {
				if (getSessionDate($ThisSession) == $vDate) {
					if ( $vStart >= getSessionStart($ThisSession) AND $vStart <= getSessionEnd($ThisSession)) {
						$message = "Error: There is already a session at that time for that location.";
						echo "<script type='text/javascript'>alert('$message');</script>";
						return false;
					}
					if ( $vEnd >= getSessionStart($ThisSession) AND $vEnd <= getSessionEnd($ThisSession)) {
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
	
	function addstudent($the_session, $the_user) {
		$attendlist = getSessionAttended($the_session);
		if (strlen($attendlist) == 0) {
			$attendarr[] = $the_user;
		}
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
	
	function removestudent($the_session, $the_user) {
		$attendlist = getSessionAttended($the_session);
		$attendarr = explode(',', $attendlist);
		if (($key = array_search($the_user, $attendarr)) !== false) {
			unset($attendarr[$key]);
		}
		$attendlist = implode(',', $attendarr);
		$setsuccess = setSessionAttended($the_session, $attendlist);
		return $setsuccess;
	}

	function showstudentlist($the_session, $attend_change){
		$rosterlist = getRosterStudentList(getSessionRosterID($the_session));
		if (strlen($rosterlist) == 0) {
			echo "Roster has no students.";
		}
		else {
			$students = explode(',', $rosterlist);
			$attendlist = getSessionAttended($the_session);
			$attendarr = explode(',', $attendlist);

			echo "<form action='";
			echo htmlspecialchars($_SERVER["PHP_SELF"]);
			echo "' method='post'>";
			foreach($students as $aStudent)
			{
				echo getUserFirstName($aStudent) . " " . getUserLastName($aStudent);
				echo " (" . getUserEmail($aStudent). ") &nbsp;";
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