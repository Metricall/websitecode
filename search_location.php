	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<center>Search:
 			<select name="typeofsearch">
				<option value="location">Location</option>
			</select>
			<input type="text" name="searchvalue">
			<input type="submit" value="Search" />
		</center><br>
	</form>
	<center>
		<table id="infoTable" class="infoTable">
		<?php
			if(isset($_POST["searchvalue"])) {
				$foundID = givelocationID($_POST["searchvalue"]);
				if ($foundID < 0) {
					echo "No search results.  Try again.";
				}
				else {
					echo "ID of ".getLocationBuilding($foundID)." ".getLocationRoom($foundID)." is $foundID";
				}
			}
		?>
			
		</table>
	</center>
<?php
	//given a search term for a Location Building and Room, return Location ID if found
	function givelocationID($svalue){
		$cleanvalue = cleaninput($svalue);
		
		$locations = explode(',', getLocationList());
		foreach($locations as $l) {
			if ($cleanvalue == getLocationBuilding($l)." ".getLocationRoom($l)) {
				return $l;
			}
		}
		//if not found
		return -1;
	}
?>