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
	mysqli_close($conn);
	return false;
}
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
	$sql_list = mysqli_fetch_all($result);
	foreach($sql_list as $aSession)
	{
		$list[] = $aSession[0];
	}
	$liststring = implode(',', $list);
	return $liststring;
	mysqli_close($conn);
	exit;
}
else {
    echo "Error retreiving record: " . mysqli_error($conn);
	mysqli_close($conn);
	return false;
}
}

function getRosterListByInstructor($instructor) {
include 'DatabaseInfo.php';
// Create Connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$fn = strtok($instructor, " ");
$ln = strtok(" ");
$userID = getInstructorIDByName($fn, $ln);
$sql = "SELECT Roster_ID FROM Roster WHERE Instructor_ID = '".$userID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
    echo "Record retrived successfully <br>";
	$sql_list = mysqli_fetch_all($result);
	foreach($sql_list as $aSession)
	{
		$list[] = $aSession[0];
	}
	$liststring = implode(',', $list);
	return $liststring;
	mysqli_close($conn);
	exit;
}
else {
    echo "Error retreiving record: " . mysqli_error($conn);
	mysqli_close($conn);
	return false;
}
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
	mysqli_close($conn);
	return false;
}
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
	mysqli_close($conn);
	return false;
}
}

function getSessionStart($sessionID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}	
$sql = "SELECT Start_Time FROM Session WHERE Session_ID = '".$sessionID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
    echo "Record retrived successfully";
	$timeentry = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $timeentry["Start_Time"];
}
else {
    echo "Error retreiving record: " . mysqli_error($conn);
	mysqli_close($conn);
	return false;
}
}

function getSessionEnd($sessionID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}	
$sql = "SELECT End_Time FROM Session WHERE Session_ID = '".$sessionID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
    echo "Record retrived successfully";
	$timeentry = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $timeentry["End_Time"];
}
else {
    echo "Error retreiving record: " . mysqli_error($conn);
	mysqli_close($conn);
	return false;
}
}

function getSessionRosterID($sessionID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}	
$sql = "SELECT Roster_ID FROM Session WHERE Session_ID = '".$sessionID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
    echo "Record retrived successfully";
	$rosterentry = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $rosterentry["Roster_ID"];
}
else {
    echo "Error retreiving record: " . mysqli_error($conn);
	mysqli_close($conn);
	return false;
}
}

function getSessionLocationID($sessionID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}	
$sql = "SELECT Location_ID FROM Session WHERE Session_ID = '".$sessionID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
    echo "Record retrived successfully";
	$locationentry = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $locationentry["Location_ID"];
}
else {
    echo "Error retreiving record: " . mysqli_error($conn);
	mysqli_close($conn);
	return false;
}
}

function getSessionAttended($sessionID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}	
$sql = "SELECT Attended FROM Session WHERE Session_ID = '".$sessionID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
    echo "Record retrived successfully";
	$attendedentry = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $attendedentry["Attended"];
}
else {
    echo "Error retreiving record: " . mysqli_error($conn);
	mysqli_close($conn);
	return false;
}
}

function getRosterCourseName($rosterID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}	
$sql = "SELECT Course_Name FROM Roster WHERE Roster_ID = '".$rosterID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
    echo "Record retrived successfully";
	$cname = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $cname["Course_Name"];
}
else {
    echo "Error retreiving record: " . mysqli_error($conn);
	mysqli_close($conn);
	return false;
}
}

function getRosterInstructor($rosterID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}	
$sql = "SELECT Instructor_ID FROM Roster WHERE Roster_ID = '".$rosterID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
    echo "Record retrived successfully";
	$inum = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $inum["Instructor_ID"];
}
else {
    echo "Error retreiving record: " . mysqli_error($conn);
	mysqli_close($conn);
	return false;
}
}

function getRosterLocation($rosterID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}	
$sql = "SELECT Default_Location FROM Roster WHERE Roster_ID = '".$rosterID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
    echo "Record retrived successfully";
	$dloc = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $dloc["Default_Location"];
}
else {
    echo "Error retreiving record: " . mysqli_error($conn);
	mysqli_close($conn);
	return false;
}
}

function getLocationRoom($locationID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}	
$sql = "SELECT Room_No FROM Location WHERE Location_ID = '".$locationID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
    echo "Record retrived successfully";
	$rnum = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $rnum["Room_No"];
}
else {
    echo "Error retreiving record: " . mysqli_error($conn);
	mysqli_close($conn);
	return false;
}
}

function getLocationBuilding($locationID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}	
$sql = "SELECT Building_Name FROM Location WHERE Location_ID = '".$locationID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
    echo "Record retrived successfully";
	$bname = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $bname["Building_Name"];
}
else {
    echo "Error retreiving record: " . mysqli_error($conn);
	mysqli_close($conn);
	return false;
}
}

function getLocationLocked($locationID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}	
$sql = "SELECT Locked FROM Location WHERE Location_ID = '".$locationID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
    echo "Record retrived successfully";
	$lock = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $lock["Locked"];
}
else {
    echo "Error retreiving record: " . mysqli_error($conn);
	mysqli_close($conn);
	return false;
}
}

function getUserFirstName($stdID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}	
$sql = "SELECT Fname FROM Users WHERE Std_ID = '".$stdID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
    echo "Record retrived successfully";
	$fn = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $fn["Fname"];
}
else {
    echo "Error retreiving record: " . mysqli_error($conn);
	mysqli_close($conn);
	return false;
}
}

function getUserLastName($stdID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}	
$sql = "SELECT Lname FROM Users WHERE Std_ID = '".$stdID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
    echo "Record retrived successfully";
	$ln = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $ln["Lname"];
}
else {
    echo "Error retreiving record: " . mysqli_error($conn);
	mysqli_close($conn);
	return false;
}
}

function getUserEmail($stdID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}	
$sql = "SELECT Email_Address FROM Users WHERE Std_ID = '".$stdID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
    echo "Record retrived successfully";
	$mail = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $mail["Email_Address"];
}
else {
    echo "Error retreiving record: " . mysqli_error($conn);
	mysqli_close($conn);
	return false;
}
}

function getUserRole($stdID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}	
$sql = "SELECT Role FROM Users WHERE Std_ID = '".$stdID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
    echo "Record retrived successfully";
	$roll = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $roll["Role"];
}
else {
    echo "Error retreiving record: " . mysqli_error($conn);
	mysqli_close($conn);
	return false;
}
}

function getUserPassword($stdID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}	
$sql = "SELECT Password FROM Users WHERE Std_ID = '".$stdID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
    echo "Record retrived successfully";
	$pass = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $pass["Password"];
}
else {
    echo "Error retreiving record: " . mysqli_error($conn);
	mysqli_close($conn);
	return false;
}
}

function getUserLocked($stdID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}	
$sql = "SELECT Locked FROM Users WHERE Std_ID = '".$stdID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
    echo "Record retrived successfully";
	$lock = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $lock["Locked"];
}
else {
    echo "Error retreiving record: " . mysqli_error($conn);
	mysqli_close($conn);
	return false;
}
}

//Getter for biometric data field when it is added
/*
function getUserBiometric($stdID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}	
$sql = "SELECT Biometric FROM Users WHERE Std_ID = '".$stdID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
    echo "Record retrived successfully";
	$bio = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $bio["Biometric"];
}
else {
    echo "Error retreiving record: " . mysqli_error($conn);
	mysqli_close($conn);
	return false;
}
}
*/
?>















