	<div class = 'row' id = 'yourclasses'>
	<div class = 'col-xs-5'></div>
	<div class = 'col-xs-7'><h2>Create a Session</h2></div>
	</div><br>
	<div class = 'row' id = 'firstform'>
	<div class = 'col-xs-3'></div>
	<div class = 'col-xs-2'> Session Name </div>
	<div class = 'col-xs-1'><input type = 'text' id = 'box'></div>
	</div><br>
	<div class = 'row' id = 'lastform'>
	<div class = 'col-xs-3'></div>
	<div class = 'col-xs-2'> Session Date </div>
	<div class = 'col-xs-1'><input type = 'text' id = 'box'></div>
	</div><br>
	<div class = 'row' id = 'emailform'>
	<div class = 'col-xs-3'></div>
	<div class = 'col-xs-2'> Session From </div>
	<div class = 'col-xs-1'><input type = 'text' id = 'box'></div>
	</div><br>
	<div class = 'row' id = 'messageform'>
	<div class = 'col-xs-3'></div>
	<div class = 'col-xs-2'> Session To </div>
	<div class = 'col-xs-1'><input type = 'text' id = 'box'></div>
	</div><br>
	<div class = 'row' id = 'sendbutton'>
	<div class = 'col-xs-5'></div>
	<div class = 'col-xs-3'><input type = 'submit' id = 'submitform' value = 'Create'></div>
	</div><br><br><br>
	
	<div align='center'>
	<table border='1' id = 'roster'>
  <tr>
	<th id = 'color11'>Date</th>
    <th id = 'color22'>Start</th>
	<th id = 'color22'>End</th>
    <th id = 'color11'>Location</th>
    <th id = 'color11'>Modify</th>
  </tr>
  <?php
		$sessionlist = getSessionListByRoster($_SESSION["rid"]);
		if (strlen($sessionlist) == 0) {
			echo "This class does not have any sessions.  Try creating some.";
		}
		else {
			$sessions = explode(',', $sessionlist);
			echo "<form action='sessionmod.php' method='get'>";
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
				echo "</td><td id = 'color11'>";
				echo "<button type='submit' value='";
				echo $aSession;
				echo "' name='sid'>Modify</button></td></tr>";
			}
			echo "</form>";
		}
  ?>
</table>
</div>