<?PHP
$DB_servername = "localhost";
$DB_username = "*******************";
$DB_password = "**********************";
$DB_name = "**********************";
$username = $_POST['Username'];
$password = $_POST['Password'];

// Create connection
$conn = mysqli_connect($DB_servername, $DB_username, $DB_password, $DB_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT Std_ID, Fname FROM Users WHERE Std_ID = '".$username."' AND Password = '".$password."'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
	$result = mysqli_query($conn, $sql);
    $sql = "SELECT Role FROM Users WHERE Std_ID = '".$username."' AND Password = '".$password."'";
	$role = mysqli_fetch_assoc($result);
	if (($role["Role"]) == "Professor"){
		echo "This is a Professor Account";
		header('Refresh: 5; URL=http://metrical.name/professormain.html');
	}
	else if (($role["Role"]) == "Student") {
		echo "This is a Student Account. You will be redirected to the student page in a bit.";
		//header('Refresh: 5; URL=http://metrical.name/studentmain.html');
	}
	else if (($role["Role"]) == "Admin") {
		echo "This is an Admin Account. You will be redirected.";
		header('Refresh: 5; URL=http://metrical.name/adminmain.html');
	}
	else {
		echo "Role Not found";
	}
} 
else {
    echo "Username And/Or Password Not found. You will be redirected to the login page to try again";
	header('Refresh: 5; URL=http://metrical.name');
}

mysqli_close($conn);
?>







