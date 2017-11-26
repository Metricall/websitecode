	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<center>Search:
 			<select name="typeofsearch">
				<option value="professor">Professor</option>
				<option value="number">User ID</option>
			</select>
			<input type="text" name="searchvalue">
			<input type="submit" value="Search" />
		</center><br>
	</form>
	<center>
		<table id="infoTable" class="infoTable">
		<?php
			if(isset($_POST["searchvalue"])) {
				instructorlist($_POST["typeofsearch"],$_POST["searchvalue"]);
			}
		?>
			
		</table>
	</center>
<?php
	function instructorlist($stype, $svalue){
		//by name, get userIDs -> make array. by number, make array with that number
		$cleanvalue = cleaninput($svalue);
		if ($stype == "professor") {
			$ulist = getUserIDsByName($cleanvalue);
			$ulist = explode(',', $ulist);
		}
		elseif ($stype == "number") {
			$ulist[] = $cleanvalue;
		}
		//if potential users are professor and not locked, add to instructor list
		$instructors = array();
		foreach($ulist as $u) {
			if(getUserRole($u) == "Professor" AND getUserLocked($u) == 0)
				$instructors[] = $u;
		}
		//display instructor list and allow admin to choose (usually only will be 1 choice though)
		if (count($instructors) == 0) {
			echo "No search results.  Try again.";
		}
		else {
			echo "<form action='";
			echo htmlspecialchars($_SERVER["PHP_SELF"]);
			echo "' method='post'>";
			foreach($instructors as $aInstructor)
			{
				echo getUserFirstName($aInstructor) . " " . getUserLastName($aInstructor);
				echo " (" . getUserEmail($aInstructor). ") &nbsp;";
				echo "<button type='submit' value='";
				echo $aInstructor;
				echo "' name='profchoice'>Confirm</button><br>";
			}
			echo "</form>";
		}
	}
?>