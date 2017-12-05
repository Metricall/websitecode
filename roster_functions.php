<?php
	//generate a selectable list of rosters for the given userID
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
	
	//shows roster info.  if $edit_link is true, show link to edit it
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
	
	//adds roster to database
	//generates a unique ID for it based on time, returns that ID
	function newroster($name, $instructor, $location){
		$newRID = date("YmdHis");
		if(strlen($name) < 1 or strlen($name) > 30) {
			echo '<script type="text/javascript">alert("Error: Name must be 1-30 characters long."); </script>';
			return false;
		}
		if(addNewRoster($newRID, $name, $instructor, $location)) {
			return $newRID;
		}
		else
			return false;
	}
	
	//add user with given userID to roster
	function addstudent($the_rost, $the_user) {
		$rosterlist = getRosterStudentList($the_rost);
		//roster is empty, just add user
		if (strlen($rosterlist) == 0) {
			$rosterarr[] = $the_user;
		}
		//roster not empty, check if user is already in roster first
		else {
			$rosterarr = explode(',', $rosterlist);
			foreach ($rosterarr as $aStudent) {
				if ($aStudent == $the_user) {
					echo "<script type='text/javascript'>alert('User is already in this Roster.');</script>";
					return false;
				}
			}
			//add user to roster
			$rosterarr[] = $the_user;
			sort($rosterarr);
		}	
		//construct new string with current student added
		$rosterlist = implode(',', $rosterarr);
		//set new string of students to Roster
		$setsuccess = setRosterStudentList($the_rost, $rosterlist);
		return $setsuccess;
	}
	
	//remove user with given userID from roster
	function removestudent($the_rost, $the_user) {
		$rosterlist = getRosterStudentList($the_rost);
		$rosterarr = explode(',', $rosterlist);
		//search for user in roster, remove if found
		if (($key = array_search($the_user, $rosterarr)) !== false) {
			unset($rosterarr[$key]);
		}
		$rosterlist = implode(',', $rosterarr);
		$setsuccess = setRosterStudentList($the_rost, $rosterlist);
		return $setsuccess;
	}
	
	//displays list of users in the given roster
	//if $remove_buttons is true, show buttons to remove user from roster
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