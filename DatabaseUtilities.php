<?PHP

//--------------------------------------------------------
//SET FUNCTIONS
//--------------------------------------------------------


function setSessionDate($the_Session_ID, $the_Date){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "UPDATE Session SET Date = '".$the_Date."' WHERE Session_ID = '".$the_Session_ID."'";
if (mysqli_query($conn, $sql)) {
	mysqli_close($conn);
	return true;
} else {
	mysqli_close($conn);
	return false;
}
}

function setSessionStart($the_Session_ID, $the_Start){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "UPDATE Session SET Start_Time = '".$the_Start."' WHERE Session_ID = '".$the_Session_ID."'";
if (mysqli_query($conn, $sql)) {
	mysqli_close($conn);
	return true;
} else {
	mysqli_close($conn);
	return false;
}
}

function setSessionEnd($the_Session_ID, $the_End){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "UPDATE Session SET End_Time = '".$the_End."' WHERE Roster_ID = '".$the_Session_ID."'";
if (mysqli_query($conn, $sql)) {
	mysqli_close($conn);
	return true;
} else {
	mysqli_close($conn);
	return false;
}
}

function setSessionRosterID($the_Session_ID, $the_roster){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "UPDATE Session SET Roster_ID = '".$the_roster."' WHERE Session_ID = '".$the_Session_ID."'";
if (mysqli_query($conn, $sql)) {
	mysqli_close($conn);
	return true;
} else {
	mysqli_close($conn);
	return false;
}
}

function setSessionLocationID($the_Session_ID, $the_location){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "UPDATE Session SET Location_ID = '".$the_location."' WHERE Session_ID = '".$the_Session_ID."'";
if (mysqli_query($conn, $sql)) {
	mysqli_close($conn);
	return true;
} else {
	mysqli_close($conn);
	return false;
}
}

function setSessionAttended($the_Session_ID, $the_attended){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "UPDATE Session SET Location_ID = '".$the_attended."' WHERE Session_ID = '".$the_Session_ID."'";
if (mysqli_query($conn, $sql)) {
	mysqli_close($conn);
	return true;
} else {
	mysqli_close($conn);
	return false;
}
}

function setRosterCourseName($the_Roster_ID, $the_Course_Name){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}
$sql = "UPDATE Roster SET Course_Name = '".$the_Course_Name."' WHERE Roster_ID = '".$the_Roster_ID."'";
if (mysqli_query($conn, $sql)) {
	mysqli_close($conn);
	return true;
} else {
	mysqli_close($conn);
	return false;
}
}



function setRosterStudentList($rosterID, $studentList){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}
$sql = "UPDATE Roster SET Student_List = '".$studentList."' WHERE Roster_ID = '".$rosterID."'";
if (mysqli_query($conn, $sql)) {
	mysqli_close($conn);
	return true;
} else {
	mysqli_close($conn);
	return false;
}
}

function setRosterInstructor($rosterID, $the_instructor){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}
$sql = "UPDATE Roster SET Instructor_ID = '".$the_instructor."' WHERE Roster_ID = '".$rosterID."'";
if (mysqli_query($conn, $sql)) {
	mysqli_close($conn);
	return true;
} else {
	mysqli_close($conn);
	return false;
}
}

function setRosterLocation($rosterID, $the_location){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}
$sql = "UPDATE Roster SET Default_Location = '".$the_location."' WHERE Roster_ID = '".$rosterID."'";
if (mysqli_query($conn, $sql)) {
	mysqli_close($conn);
	return true;
} else {
	mysqli_close($conn);
	return false;
}
}

function setLocationRoom($locationID, $the_room){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}
$sql = "UPDATE Location SET Room_No = '".$the_room."' WHERE Location_ID = '".$locationID."'";
if (mysqli_query($conn, $sql)) {
	mysqli_close($conn);
	return true;
} else {
	mysqli_close($conn);
	return false;
}
}

function setLocationBuilding($locationID, $the_building){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}
$sql = "UPDATE Location SET Building_Name = '".$the_building."' WHERE Location_ID = '".$locationID."'";
if (mysqli_query($conn, $sql)) {
	mysqli_close($conn);
	return true;
} else {
	mysqli_close($conn);
	return false;
}
}

function setLocationLocked($locationID, $the_lock){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}
$sql = "UPDATE Location SET Locked = '".$the_lock."' WHERE Location_ID = '".$locationID."'";
if (mysqli_query($conn, $sql)) {
	mysqli_close($conn);
	return true;
} else {
	mysqli_close($conn);
	return false;
}
}

function setUserFirstName($userID, $the_fn){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}
$sql = "UPDATE User SET Fname = '".$the_fn."' WHERE Std_ID = '".$userID."'";
if (mysqli_query($conn, $sql)) {
	mysqli_close($conn);
	return true;
} else {
	mysqli_close($conn);
	return false;
}
}

function setUserLastName($userID, $the_ln){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}
$sql = "UPDATE User SET Lname = '".$the_ln."' WHERE Std_ID = '".$userID."'";
if (mysqli_query($conn, $sql)) {
	mysqli_close($conn);
	return true;
} else {
	mysqli_close($conn);
	return false;
}
}

//might need checking to prevent duplicating email
function setUserEmail($userID, $the_email){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}
$sql = "UPDATE User SET Email_Address = '".$the_email."' WHERE Std_ID = '".$userID."'";
if (mysqli_query($conn, $sql)) {
	mysqli_close($conn);
	return true;
} else {
	mysqli_close($conn);
	return false;
}
}

function setUserRole($userID, $the_role){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}
$sql = "UPDATE User SET Role = '".$the_role."' WHERE Std_ID = '".$userID."'";
if (mysqli_query($conn, $sql)) {
	mysqli_close($conn);
	return true;
} else {
	mysqli_close($conn);
	return false;
}
}

function setUserPassword($userID, $the_pass){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}
$sql = "UPDATE User SET Password = '".$the_pass."' WHERE Std_ID = '".$userID."'";
if (mysqli_query($conn, $sql)) {
	mysqli_close($conn);
	return true;
} else {
	mysqli_close($conn);
	return false;
}
}

function setUserLocked($userID, $the_lock){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}
$sql = "UPDATE User SET Locked = '".$the_lock."' WHERE Std_ID = '".$userID."'";
if (mysqli_query($conn, $sql)) {
	mysqli_close($conn);
	return true;
} else {
	mysqli_close($conn);
	return false;
}
}

//setter for biometric data field when it is added
/*
function setUserBiometric($userID, $the_bio){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}
$sql = "UPDATE User SET Biometric = '".$the_bio."' WHERE Std_ID = '".$userID."'";
if (mysqli_query($conn, $sql)) {
	mysqli_close($conn);
	return true;
} else {
	mysqli_close($conn);
	return false;
}
}
*/

/*  what is this thing?
function UpdateInstID($the_Roster_Id, $the_Instructor_ID, $the_First_Name, $the_Last_Name){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//$sql = "UPDATE Roster SET Course_Name = '".$the_Course_Name."' WHERE Roster_ID = '".$the_Roster_ID."'";
if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
mysqli_close($conn);
}
*/

//--------------------------------------------------------
//ADD FUNCTIONS
//--------------------------------------------------------
function addNewRoster($Roster_ID, $Instructor_ID, $LocationID) {
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}
$sql = "INSERT INTO Roster (Roster_ID, Course_Name, Student_List, Instructor_ID, Default_Location) VALUES ('".$Roster_ID."', '', '', '".$Instructor_ID."', '".$LocationID."')";
if (mysqli_query($conn, $sql)) {
	mysqli_close($conn);
	return true;
} else {
	mysqli_close($conn);
	return false;
}
}


//--------------------------------------------------------
//GET FUNCTIONS
//--------------------------------------------------------

//$locationID is a Location_ID
//returns list of all sessions at that location
function getSessionListByLoc($locationID) {
include 'DatabaseInfo.php';
// Create Connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}	
$sql = "SELECT Session_ID FROM Session WHERE Location_ID = '".$locationID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
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
	mysqli_close($conn);
	return false;
}
}

//$rosterID is a Roster_ID
//returns list of all sessions at that roster
function getSessionListByRoster($rosterID) {
include 'DatabaseInfo.php';
// Create Connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}	
$sql = "SELECT Session_ID FROM Session WHERE Roster_ID = '".$rosterID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
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
	mysqli_close($conn);
	return false;
}
}


//$instructorID is instructor's userID
//returns list of their classes
function getRosterListByInstructor($instructorID) {
include 'DatabaseInfo.php';
// Create Connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}
$sql = "SELECT Roster_ID FROM Roster WHERE Instructor_ID = '".$instructorID."'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0)  {
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
	mysqli_close($conn);
	return false;
}
}

//returns list of all non-locked locations
function getLocationList() {
include 'DatabaseInfo.php';
// Create Connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}
$sql = "SELECT Location_ID FROM Location WHERE Locked = '0'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0)  {
	$sql_list = mysqli_fetch_all($result);
	foreach($sql_list as $aLocation)
	{
		$list[] = $aLocation[0];
	}
	$liststring = implode(',', $list);
	return $liststring;
	mysqli_close($conn);
	exit;
}
else {
	mysqli_close($conn);
	return false;
}
}

//$name is string with <firstname> <lastname> with a space in between
//returns list of users with matching name (multiple users can have same name)
function getUserIDsByName($name) {
include 'DatabaseInfo.php';
// Create Connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}
//tokenize name to get first and last names
$fn = strtok($name, " ");
$ln = strtok(" ");
$sql = "SELECT Std_ID FROM Users WHERE Fname = '".$fn."' AND Lname = '".$ln."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
	$sql_list = mysqli_fetch_all($result);
	foreach($sql_list as $aUser)
	{
		$list[] = $aUser[0];
	}
	$liststring = implode(',', $list);
	return $liststring;
	mysqli_close($conn);
	exit;
}
else {
	mysqli_close($conn);
	return false;
}
}
	
function getSessionDate($sessionID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}	
$sql = "SELECT Date FROM Session WHERE Session_ID = '".$sessionID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
	$dateentry = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $dateentry["Date"];
}
else {
	mysqli_close($conn);
	return false;
}
}

function getSessionStart($sessionID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}	
$sql = "SELECT Start_Time FROM Session WHERE Session_ID = '".$sessionID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
	$timeentry = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $timeentry["Start_Time"];
}
else {
	mysqli_close($conn);
	return false;
}
}

function getSessionEnd($sessionID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}	
$sql = "SELECT End_Time FROM Session WHERE Session_ID = '".$sessionID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
	$timeentry = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $timeentry["End_Time"];
}
else {
	mysqli_close($conn);
	return false;
}
}

function getSessionRosterID($sessionID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}	
$sql = "SELECT Roster_ID FROM Session WHERE Session_ID = '".$sessionID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
	$rosterentry = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $rosterentry["Roster_ID"];
}
else {
	mysqli_close($conn);
	return false;
}
}

function getSessionLocationID($sessionID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}	
$sql = "SELECT Location_ID FROM Session WHERE Session_ID = '".$sessionID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
	$locationentry = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $locationentry["Location_ID"];
}
else {
	mysqli_close($conn);
	return false;
}
}

function getSessionAttended($sessionID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}	
$sql = "SELECT Attended FROM Session WHERE Session_ID = '".$sessionID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
	$attendedentry = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $attendedentry["Attended"];
}
else {
	mysqli_close($conn);
	return false;
}
}

function getRosterCourseName($rosterID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}	
$sql = "SELECT Course_Name FROM Roster WHERE Roster_ID = '".$rosterID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
	$cname = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $cname["Course_Name"];
}
else {
	mysqli_close($conn);
	return false;
}
}

function getRosterStudentList($rosterID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}	
$sql = "SELECT Student_List FROM Roster WHERE Roster_ID = '".$rosterID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
	$list = mysqli_fetch_assoc($result);
	$liststring = $list["Student_List"];
	return $liststring;
	mysqli_close($conn);
	exit;
}
else {
	mysqli_close($conn);
	return false;
}
}

function getRosterInstructor($rosterID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}	
$sql = "SELECT Instructor_ID FROM Roster WHERE Roster_ID = '".$rosterID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
	$inum = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $inum["Instructor_ID"];
}
else {
	mysqli_close($conn);
	return false;
}
}

function getRosterLocation($rosterID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}	
$sql = "SELECT Default_Location FROM Roster WHERE Roster_ID = '".$rosterID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
	$dloc = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $dloc["Default_Location"];
}
else {
	mysqli_close($conn);
	return false;
}
}

function getLocationRoom($locationID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}	
$sql = "SELECT Room_No FROM Location WHERE Location_ID = '".$locationID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
	$rnum = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $rnum["Room_No"];
}
else {
	mysqli_close($conn);
	return false;
}
}

function getLocationBuilding($locationID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}	
$sql = "SELECT Building_Name FROM Location WHERE Location_ID = '".$locationID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
	$bname = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $bname["Building_Name"];
}
else {
	mysqli_close($conn);
	return false;
}
}

function getLocationLocked($locationID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}	
$sql = "SELECT Locked FROM Location WHERE Location_ID = '".$locationID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
	$lock = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $lock["Locked"];
}
else {
	mysqli_close($conn);
	return false;
}
}

function getUserFirstName($stdID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}	
$sql = "SELECT Fname FROM Users WHERE Std_ID = '".$stdID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
	$fn = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $fn["Fname"];
}
else {
	mysqli_close($conn);
	return false;
}
}

function getUserLastName($stdID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}	
$sql = "SELECT Lname FROM Users WHERE Std_ID = '".$stdID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
	$ln = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $ln["Lname"];
}
else {
	mysqli_close($conn);
	return false;
}
}

function getUserEmail($stdID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}	
$sql = "SELECT Email_Address FROM Users WHERE Std_ID = '".$stdID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
	$mail = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $mail["Email_Address"];
}
else {
	mysqli_close($conn);
	return false;
}
}

function getUserRole($stdID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}	
$sql = "SELECT Role FROM Users WHERE Std_ID = '".$stdID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
	$roll = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $roll["Role"];
}
else {
	mysqli_close($conn);
	return false;
}
}

function getUserPassword($stdID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}	
$sql = "SELECT Password FROM Users WHERE Std_ID = '".$stdID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
	$pass = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $pass["Password"];
}
else {
	mysqli_close($conn);
	return false;
}
}

function getUserLocked($stdID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}	
$sql = "SELECT Locked FROM Users WHERE Std_ID = '".$stdID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
	$lock = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $lock["Locked"];
}
else {
	mysqli_close($conn);
	return -1;
}
}

//Getter for biometric data field when it is added
/*
function getUserBiometric($stdID){
include 'DatabaseInfo.php';
// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error() . "<br>");
}	
$sql = "SELECT Biometric FROM Users WHERE Std_ID = '".$stdID."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
    echo "Record retrived successfully<br>";
	$bio = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	return $bio["Biometric"];
}
else {
    echo "Error retreiving record: " . mysqli_error($conn) . "<br>";
	mysqli_close($conn);
	return false;
}
}
*/
?>















