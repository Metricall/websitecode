<?php 
	echo "
	<div class = 'row' id = 'taskbar1'>
	<div class = 'col-xs-1'></div>
	<div class = 'col-xs-8'><h4>Welcome ";
	echo $_SESSION["instructorName"];
	echo"!</h4></div>
	<div class = 'col-xs-2'><a href = 'logout.php'><h4>Logout</h4></a></div>
	</div><br>
	";
?>