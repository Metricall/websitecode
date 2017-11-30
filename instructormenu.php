<?php
	function sayclass(){
		if (isset($_SESSION["rid"]))
			print getRosterCourseName($_SESSION["rid"]);
		else
			print "none";
	}
?>
	<div class = 'row' id = 'taskbar'>
	<div class = 'col-xs-1'></div>
	<div class = 'col-xs-4'><a href = 'professormain.php'><h4>Roster: <?php sayclass(); ?></h4></a></div>
	<div class = 'col-xs-2'><a href = '?act=session'><h4>Sessions</h4></a></div>
	<div class = 'col-xs-2'><a href = '?act=report'><h4>Reports</h4></a></div>
	<div class = 'col-xs-3'><a href = '?act=edit'><h4>Manage Attendance</h4></a></div>
	</div>