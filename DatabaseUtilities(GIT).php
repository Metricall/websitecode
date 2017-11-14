<?PHP

function setStudentList($rosterID, $studentList){
$DB_servername = "****************";
$DB_username = "***************";
$DB_password = "***************";
$DB_name = "*****************";
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "UPDATE Roster SET Student_List = '".$studentList."' WHERE Roster_ID = '".$rosterID."'";
$result = mysqli_query($conn, $sql);

if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
mysqli_close($conn);
	
}

function getStudentList($rosterID){
$DB_servername = "****************";
$DB_username = "***************";
$DB_password = "***************";
$DB_name = "*****************";
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}	
$sql = "SELECT Student_List FROM Roster WHERE Roster_ID = '".$rosterID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
    echo "Record retrived successfully";
	$list = mysqli_fetch_assoc($result);
	$liststring = $list["Student_List"];
	return $liststring;
	mysqli_close($conn);
	exit;
}
 else {
    echo "Error retreiving record: " . mysqli_error($conn);
	return false;
}
mysqli_close($conn);
}

?>






