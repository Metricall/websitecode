<?php
function attemptLogin($u, $p){
include 'DatabaseInfo.php';
include 'DatabaseUtilities.php';
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$cleanuser = filter_var($u, FILTER_SANITIZE_EMAIL);
$cleanpass = cleaninput($p);
$sql = "SELECT Std_ID FROM Users WHERE Email_Address = '".$cleanuser."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
	$info = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	$uid = $info["Std_ID"];
	if ($cleanpass == getUserPassword($uid) AND getUserLocked($uid) == 0) {
		$_SESSION["uid"] = $uid;
		$_SESSION["role"] = getUserRole($uid);
		$_SESSION["start"] = time();
		$_SESSION["expire"] = $_SESSION["start"] + 600;
		return true;
	}
	else {
		return false;
	}
}
else {
    echo "Error retreiving record: " . mysqli_error($conn);
	mysqli_close($conn);
	return false;
}
}

function checkLogin() {
//check that there is a uid
if (!isset($_SESSION["uid"])) {
	header("Location: logout.php");
	return false;
}
//check if timeout
elseif ($_SESSION["expire"] - time() < 0) {
	header("Location: logout.php");
	return false;
}
else {
	$_SESSION["expire"] = time() + 600;
	return true;
}
}

function cleaninput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
