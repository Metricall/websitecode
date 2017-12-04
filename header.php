	<div class = 'row' id = 'logo'>
	<div class = 'col-xs-1'></div>
	<a href = 'metricalsite.php'>
	<div class = 'col-xs-2'><img src = 'metrical3.png' width = '80px' ></div>
	<div class = 'col-xs-4'><h2>M e t r i c a l </h2></div>
	</a>
	<div class = 'col-xs-4'>
	<font face="verdana">
	<?php		
		if (isset($_SESSION["role"])) {
			$user_role = $_SESSION["role"];
			$user_name = $_SESSION["adminName"];
			$user_prof = $_SESSION["instructorName"];

			if($user_role == "Admin"){
				echo   "
					<a href='adminmain.php' style=\"color:#000080;\" onmouseover = \"this.style.color = 'red';\"
						onmouseout = \"this.style.color = '#000080';\"> $user_role </a>
					<br> $user_name <br>
				";
			}
			else {
				echo   "
					<a href='professormain.php' style=\"color:#000080;\" onmouseover = \"this.style.color = 'red';\"
						onmouseout = \"this.s<tyle.color = '#000080';\"> $user_role </a>
					<br> $user_prof <br>
				";
			}
			echo   "
				<a href='logout.php' style='color:#000080;' onmouseover = \"this.style.color = 'red';\"
					onmouseout = \"this.style.color = '#000080';\">Logout</a>
				";
		}
	?>
	</font>
	</div>
	</div>
<?php
	if (isset($pagetype)){
		if ($pagetype == "Admin")
			include 'adminmenu.php';
		elseif ($pagetype == "Professor")
			include 'instructormenu.php';
	}
	else {
		echo "
		<div class = 'row' id = 'taskbar'>
		<div class = 'col-xs-1'></div>
		<div class = 'col-xs-2'><a href = 'products.php'><h4>Products</h4></a></div>
		<div class = 'col-xs-2'><a href = 'resources.php'><h4>Resources</h4></a></div>
		<div class = 'col-xs-2'><a href = 'news.php'><h4>News</h4></a></div>
		<div class = 'col-xs-2'><a href = 'about.php'><h4>About</h4></a></div>
		<div class = 'col-xs-2'><a href = 'contactus.php'><h4>Contact Us</h4></a></div>
		</div>
		";
	}
?>
