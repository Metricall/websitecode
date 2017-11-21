	<div class = 'row' id = 'taskbar'>
		<div class = 'col-xs-1'></div>
		<div class = 'col-xs-2'><a href = 'adminmain.php'><h4>&lt; Admin</h4></a></div>
		<div class = 'col-xs-2'><a href = 'admin_user.php'><h4>Users</h4></a></div>
		<div class = 'col-xs-2'><a href = 'admin_roster.php'><h4>Rosters</h4></a></div>
		<div class = 'col-xs-2'><a href = 'admin_location.php'><h4>Locations</h4></a></div>
		<div class = 'col-xs-2'><a href = 'admin_session.php'><h4>Sessions/Reports</h4></a></div>
	</div><br>
		<center>
			<p class="welcome">Welcome: <?php echo $_SESSION["adminName"]; ?></p>
		</center>