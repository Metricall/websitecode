<?php
session_start();
?>
<?php
	if($_SESSION["role"] == "Admin")
		header("Location: adminmain.php");
	elseif ($_SESSION["role"] == "Professor")
		header("Location: professormain.php");
?>
<!DOCTYPE html>
<!--Metrical Main Site
 -->
<html lang = "en">
 <head>
    <link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css">
	<link rel = "stylesheet" type = "text/css" href = "mainmetrical.css">
    <title> Metrical </title>
    <meta charset = "utf-8">
 </head>
 <body>
	<?php include 'header.php'; ?>
	<div class = 'row' id = 'member'>
	<div class = 'col-xs-5'></div>
	<div class = 'col-xs-4'>Already a member?</div>
	<div class = 'col-xs-3'></div>
	</div><br>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div class = 'row' id = 'login'>
	<div class = 'col-xs-4'></div>
	<div class = 'col-xs-1'>Email</div>
	<div class = 'col-xs-3'><input type="text" name="user" size="30" /></div>
	</div><br>
	<div class = 'row' id = 'pass'>
    <div class = 'col-xs-4'></div>
	<div class = 'col-xs-1'>Password</div>
	<div class = 'col-xs-3'><input type="password" name="pass" size="30" /></div>
	<div class = 'col-xs-1' align='left'><input type="submit" value="Login" /></div>
	<?php
	if (isset($_REQUEST['user'])) {
		tryAction();
	}

	function tryAction() {
		include 'LoginUtilities.php';
		$loggedin = attemptLogin($_REQUEST['user'], $_REQUEST['pass']);
		if ($loggedin) {
			if  ($_SESSION["role"] == "Student") {
				echo "Sorry, student functionality unavailable.";
				header("refresh:5; url=logout.php"); 
			}
			header("refresh:0");	//refresh since this page redirects logged in users
		}
		else
			echo "Login Failed. Please Retry.";
	}
	?>
	</div>
	</div>
	</form>
	<div class = 'row' id = 'problem'>
	<div class = 'col-xs-5'></div>
	<div class = 'col-xs-4'><a href = 'cantlogin.html'>Can't login?</a></div>
	</div>
	
	<div id = 'backimage'></div>

	<?php include 'footer.php'; ?>
  </body>
</html>