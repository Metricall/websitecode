<?php	
	function rosterlist($userID){
		$classlist = getRosterListByInstructor($userID);
		if (strlen($classlist) == 0) {
			echo "No Rosters found.";
		}
		else {
			$classes = explode(',', $classlist);
			echo "<form action='";
			echo htmlspecialchars($_SERVER["PHP_SELF"]);
			echo "' method='post'>";
			foreach($classes as $aClass)
			{
				echo "<div class = 'col-xs-12'><button type='submit' value='";
				echo $aClass;
				echo "' name='rid'>";
				echo getRosterCourseName($aClass);
				echo "</button> </div><br><br>";
			}
			echo "</form>";
		}
	}
	
	function rosterinfo($rostID, $edit_link) {
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
	
	function newroster($name, $instructor, $location){
		$newRID = date("YmdHis");
		if(addNewRoster($newRID, $instructor, $location)) {
			setRosterCourseName($newRID, $name);
			return $newRID;
		}
		else
			return false;
	}
	
	function addstudent($the_rost, $the_user) {
		$rosterlist = getRosterStudentList($the_rost);
		if (strlen($rosterlist) == 0) {
			$rosterarr[] = $the_user;
		}
		else {
			$rosterarr = explode(',', $rosterlist);
			foreach ($rosterarr as $aStudent) {
				if ($aStudent == $the_user)
					return false;
			}
				$rosterarr[] = $the_user;
			sort($rosterarr);
		}
		
		//construct new string with current student added
		$rosterlist = implode(',', $rosterarr);
		//replace attended for this session with new string containing this student
		$setsuccess = setRosterStudentList($the_rost, $rosterlist);
		return $setsuccess;
	}
	
	function removestudent($the_rost, $the_user) {
		$rosterlist = getRosterStudentList($the_rost);
		$rosterarr = explode(',', $rosterlist);
		if (($key = array_search($the_user, $rosterarr)) !== false) {
			unset($rosterarr[$key]);
		}
		$rosterlist = implode(',', $rosterarr);
		$setsuccess = setRosterStudentList($the_rost, $rosterlist);
		return $setsuccess;
	}

	function showstudentlist($the_rost, $remove_buttons){
		$rosterlist = getRosterStudentList($the_rost);
		if (strlen($rosterlist) == 0) {
			echo "Roster has no students.";
		}
		else {
			$students = explode(',', $rosterlist);
			echo "<form action='";
			echo htmlspecialchars($_SERVER["PHP_SELF"]);
			echo "' method='post'>";
			foreach($students as $aStudent)
			{
				echo getUserFirstName($aStudent) . " " . getUserLastName($aStudent);
				echo " (" . getUserEmail($aStudent). ") &nbsp;";
				if($remove_buttons) {
					echo "<button type='submit' value='";
					echo $aStudent;
					echo "' name='removeuid'>Remove</button>";
				}
				echo "<br><br>";
			}
			echo "</form>";
		}
	}

?>