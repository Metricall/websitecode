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
	
	function rosterinfo($rostID) {
		$the_instrucID = getRosterInstructor($rostID);
		$the_locID = getRosterLocation($rostID);
		echo getRosterCourseName($rostID)."<br>";
		echo getUserFirstName($the_instrucID)." ".getUserLastName($the_instrucID)."<br>";
		echo getLocationBuilding($the_locID)." ".getLocationRoom($the_locID)."<br>";
		echo getRosterStudentList($rostID) . "<br>";
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
?>