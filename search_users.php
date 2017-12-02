	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<center>Search:
 			<select name="typeofsearch">
				<option value="anyuser">User</option>
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
				userlist($_POST["typeofsearch"],$_POST["searchvalue"]);
			}
		?>
			
		</table>
	</center>
<?php
	function userlist($stype, $svalue){
		//by name, get userIDs -> make array. by number, make array with that number
		$cleanvalue = cleaninput($svalue);
		if ($stype == "anyuser") {
			$ulist = getUserIDsByName($cleanvalue);
			$ulist = explode(',', $ulist);
		}
		elseif ($stype == "number") {
			$ulist[] = $cleanvalue;
		}
		//only include users that are not locked
		$users = array();
		foreach($ulist as $u) {
			if(getUserLocked($u) == 0)
				$users[] = $u;
		}
		//display user list and allow admin to choose (usually only will be 1 choice though)
		if (count($users) == 0) {
			echo "No search results.  Try again.";
		}
		else {
			echo "<form action='";
			echo htmlspecialchars($_SERVER["PHP_SELF"]);
			echo "' method='post'>";
			foreach($users as $aUser)
			{
				echo getUserFirstName($aUser) . " " . getUserLastName($aUser);
				echo " (" . getUserEmail($aUser). ") &nbsp;";
				echo "<button type='submit' value='";
				echo $aUser;
				echo "' name='userchoice'>Confirm</button><br>";
			}
			echo "</form>";
		}
		echo "<br><br>";
	}
?>