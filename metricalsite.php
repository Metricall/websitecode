<?php
session_start();
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
<?php
	if($_SESSION["role"] == "Admin")
		echo '<script>document.location.replace("adminmain.html");</script>';
	elseif ($_SESSION["role"] == "Professor")
		echo '<script>document.location.replace("professormain.html");</script>';
?>
    <div class = 'row' id = 'logo'>
	<div class = 'col-xs-1'></div>
	<div class = 'col-xs-3'><h2>M e t r i c a l </h2></div>
	<div class = 'col-xs-4'><a href = 'metricalsite.html'><img src = 'metrical3.png' width = '80px' ></a></div>
	<div class = 'col-xs-5'></div>
	</div>
	<div class = 'row' id = 'taskbar'>
	<div class = 'col-xs-1'></div>
	<div class = 'col-xs-2'><a href = 'products.html'><h4>Products</h4></a></div>
	<div class = 'col-xs-2'><a href = 'resources.html'><h4>Resources</h4></a></div>
	<div class = 'col-xs-2'><a href = 'news.html'><h4>News</h4></a></div>
	<div class = 'col-xs-2'><a href = 'about.html'><h4>About</h4></a></div>
	<div class = 'col-xs-2'><a href = 'contactus.html'><h4>Contact Us</h4></a></div>
	</div><br>
	<div class = 'row' id = 'member'>
	<div class = 'col-xs-5'></div>
	<div class = 'col-xs-4'>Already a member?</div>
	<div class = 'col-xs-3'></div>
	</div><br>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div class = 'row' id = 'login'>
	<div class = 'col-xs-4'></div>
	<div class = 'col-xs-1'>Email</div>
	<div class = 'col-xs-3'><input type="text" name="user" size="20" /></div>
	</div><br>
	<div class = 'row' id = 'pass'>
    <div class = 'col-xs-4'></div>
	<div class = 'col-xs-1'>Password</div>
	<div class = 'col-xs-2'><input type="password" name="pass" size="20" /></div>
	<div class = 'col-xs-1'><input type="submit" value="Login" /></div>
<?php
if (isset($_REQUEST['user'])) {
	tryAction();
}

function tryAction() {
	include 'DatabaseUtilities.php';
	include 'LoginUtilities.php';
	$loggedin = attemptLogin($_REQUEST['user'], $_REQUEST['pass']);
	if ($loggedin) {
		if($_SESSION["role"] == "Admin")
			echo '<script>document.location.replace("adminmain.html");</script>';
		elseif ($_SESSION["role"] == "Professor")
			echo '<script>document.location.replace("professormain.html");</script>';
		elseif  ($_SESSION["role"] == "Student")
			echo "Sorry, Student Login Not Available.";
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
	
	<div class = 'row' id = 'footerOne'>
	<div class = 'col-xs-2'></div>
	<div class = 'col-xs-2'><a href = 'contactus.html'><h4>Contact Us</h4></a></div>
	<div class = 'col-xs-2'><a href = 'socialmedia.html'><h4>Social Media</h4></a></div>
	<div class = 'col-xs-2'><a href = 'developers.html'><h4>Developers</h4></a></div>
	<div class = 'col-xs-2'><a href = 'subscribe.html'><h4>Subscribe</h4></a></div>
	<div class = 'col-xs-2'></div>
	</div>

  </body>
</html>