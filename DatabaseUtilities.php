<?PHP

//--------------------------------------------------------
//SET FUNCTIONS
//--------------------------------------------------------


function setStudentList($rosterID, $studentList){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "UPDATE Roster SET Student_List = '".$studentList."' WHERE Roster_ID = '".$rosterID."'";
//$result = mysqli_query($conn, $sql);

if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
mysqli_close($conn);
	
}

function setCourseName($the_Roster_ID, $the_Course_Name){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "UPDATE Roster SET Course_Name = '".$the_Course_Name."' WHERE Roster_ID = '".$the_Roster_ID."'";

if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
mysqli_close($conn);
	
}
//--------------------------------------------------------
//ADD FUNCTIONS
//--------------------------------------------------------
function addNewRoster($Roster_ID, $Instructor_ID, $LocationID) {
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "INSERT INTO Roster (Roster_ID, Course_Name, Student_List, Instructor_ID, Default_Location) VALUES ('".$Roster_ID."', '', '', '".$Instructor_ID."', '".$LocationID."')";
if (mysqli_query($conn, $sql)) {
    echo "Record added successfully";
} else {
    echo "Error adding record: " . mysqli_error($conn);
}
mysqli_close($conn);
	
}	


//--------------------------------------------------------
//GET FUNCTIONS
//--------------------------------------------------------
function getStudentList($rosterID){
include 'DatabaseInfo.php';
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

function getSessionListByLoc($locationID) {
include 'DatabaseInfo.php';
// Create Connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}	
$sql = "SELECT Session_ID FROM Session WHERE Location_ID = '".$locationID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
    echo "Record retrived successfully";
	$list = mysqli_fetch_all($result);
	return $list;
	mysqli_close($conn);
	exit;
}
 else {
    echo "Error retreiving record: " . mysqli_error($conn);
	return false;
}
mysqli_close($conn);
}

function getInstructorIDByName($Fname, $Lname) {
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}	
$sql = "SELECT Std_ID FROM Users WHERE Fname = '".$Fname."' AND Lname = '".$Lname."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
	$query = mysqli_fetch_assoc($result);
	$the_ID = $query["Std_ID"];
	return $the_ID;
	mysqli_close($conn);
	exit;
}
 else {
    echo "Error retreiving record: " . mysqli_error($conn);
	return false;
}
mysqli_close($conn);
}	
	
function getSessionDate($sessionID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}	
$sql = "SELECT Date FROM Session WHERE Session_ID = '".$sessionID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
    echo "Record retrived successfully";
	$dateentry = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $dateentry["Date"];
}
 else {
    echo "Error retreiving record: " . mysqli_error($conn);
	return false;
}
mysqli_close($conn);
}
?>















