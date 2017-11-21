	<script src = "roster.js"></script>
	<form name="form1" method="POST">
		<center>Search:
			<select id="myDropdown" onchange="itemSelected();">
				<option value="roster">Roster ID</option>
				<option value="session">Session ID</option>
				<option value="student">Student</option>
				<option value="location">Location</option>
				<option value="professor">Professor</option>
			</select>
			<input type = "text" id="searchTarget">
			<input type="submit" value="Submit" name="submit" onclick="showSearch();">
		</center><br>
	</form>
