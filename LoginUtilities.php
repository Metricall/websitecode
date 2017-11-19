<?php
session_start();
?>

<?php
function attemptLogin($u, $p){
include 'DatabaseInfo.php';
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT Std_ID FROM Users WHERE Email_Address = '".$u."'";
$result = mysqli_query($conn, $sql);	
if (mysqli_num_rows($result) > 0)  {
	$info = mysqli_fetch_assoc($result);
	mysqli_close($conn);
	$uid = $info["Std_ID"];
	if ($p == getUserPassword($uid) AND getUserLocked($uid) == 0) {
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
	echo '<script>document.location.replace("logout.php");</script>';
	return false;
}
//check if timeout
elseif ($_SESSION["expire"] - time() < 0) {
	echo '<script>document.location.replace("logout.php");</script>';
	return false;
}
else {
	$_SESSION["expire"] = time() + 600;
	return true;
}
}

?>
