<?
	function buildsessionlist($roster, $useall, $start, $end, &$sessionlist) {
		$allsessions = getSessionListByRoster($roster);
		if (strlen($allsessions) == 0) {
			echo "<script type='text/javascript'>alert('Roster has no sessions.');</script>";
			return false;
		}
		
		//$useall is true, set all sessions as session list
		if ($useall){
			$sessionlist = explode(',', $allsessions);
			return true;
		}
		//only add session to session list if in date range
		else {
			//set default time zone
			date_default_timezone_set("America/Los_Angeles");
			//date validation
			if (($vStart = strtotime($start)) === false){
				$message = "Error: ($start) is not a valid date.";
				echo "<script type='text/javascript'>alert('$message');</script>";
				return false;
			}
			if (($vEnd = strtotime($end)) === false){
				$message = "Error: ($end) is not a valid date.";
				echo "<script type='text/javascript'>alert('$message');</script>";
				return false;
			}
			//check each session for in range
			$allsessions = explode(',', $allsessions);
			foreach ($allsessions as $ThisSession) {
				$sess_date = strtotime(getSessionDate($ThisSession));
				if ($sess_date >= $vStart AND $sess_date <= $vEnd) {
					$sessionlist[] = $ThisSession;
				}
			}
			//check if at least 1 session in range
			if(count($sessionlist) > 0)
				return true;
			else {
				echo "<script type='text/javascript'>alert('Roster has no sessions in that date range.');</script>";
				return false;
			}
		}
	}
	
	function checkattendance(&$sessionlist, &$userlist, &$attendance) {
		foreach($sessionlist as $s => $aSession){
			$attendlist = getSessionAttended($aSession);
			$attendarr = explode(',', $attendlist);
			foreach($userlist as $u => $user) {
				if (($found = array_search($user, $attendarr)) !== false)
					$attendance[$u][$s] = true;
				else
					$attendance[$u][$s] = false;
			}
		}
		$numsessions = count($sessionlist);
		foreach($userlist as $u => $user) {
			$timesattended = 0;
			for($x = 0; $x < $numsessions; $x++){
				if($attendance[$u][$x])
					$timesattended++;
			}
			$attendance[$u][$numsessions] = $timesattended;
		}
	}
	
	function attendancetable(&$sessionlist, &$userlist, &$attendance) {
		$max = count($sessionlist);
		echo "<script src=\"https://www.w3schools.com/lib/w3.js\"></script><table border=\"1\" align='center' id=\"attendGrid\"><tr>
		<th align='center' onclick=\"w3.sortHTML('#attendGrid','.stud', 'td:nth-child(1)')\">ID</th>
		<th align='center' onclick=\"w3.sortHTML('#attendGrid','.stud', 'td:nth-child(2)')\">Name</th>
		";
		foreach ($sessionlist as $aSession) {
			echo "<th align='center'>";
			echo date("n/j/Y", strtotime(getSessionDate($aSession)));
			echo "</th>";
		}
		echo "<th align='center'>Total</th></tr>";
		foreach ($userlist as $u => $aUser) {
			echo "<tr class=\"stud\"><td>$aUser</td><td>";
			echo getUserLastName($aUser).", ".getUserFirstName($aUser)."</td>";
			foreach ($attendance[$u] as $stat) {
				if($stat === true)
					echo "<td align='center'>X</td>";
				elseif($stat === false)
					echo "<td>&nbsp;</td>";
				else
					echo "<td align='center'>$stat/$max</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}
	
	function reportgen($rosterID, $all, $startdate, $enddate) {
		$sessionlist = array();
		$userlist;
		$attendance = array();
		
		//check for users and build user list
		$userlist = getRosterStudentList($rosterID);
		if (strlen($userlist) == 0) {
			echo "<script type='text/javascript'>alert('Roster has no students.');</script>";
			return false;
		}
		else
			$userlist = explode(',', $userlist);
		
		//build session list
		$sessbuilt = buildsessionlist($rosterID, $all, $startdate, $enddate, $sessionlist);
		
		//fill in attendance array, then use it to output an HTML table of the attendance
		if ($sessbuilt) {
			checkattendance($sessionlist, $userlist, $attendance);
			attendancetable($sessionlist, $userlist, $attendance);
		}
	}
	

?>