<div class = 'row' id = 'logo'>
	<div class = 'col-xs-1'></div>
	<a href = 'metricalsite.php'>
	<div class = 'col-xs-2'><img src = 'metrical3.png' width = '80px' ></div>
	<div class = 'col-xs-4'><h2>M e t r i c a l </h2></div>
	</a>
	<div class = 'col-xs-4' align="right">
	<font face="verdana">
	<?php
		if (isset($pagetype)) {			
			echo   "
				<a href='metricalsite.php' style=\"color:#000080;\" onmouseover = \"this.style.color = 'red';\"
					onmouseout = \"this.style.color = '#000080';\">".$_SESSION["role"]."</a><br>
			";
			if($_SESSION["role"] == "Professor"){
				echo $_SESSION["instructorName"]."<br>";
			}
			elseif ($_SESSION["role"] == "Admin" AND $pagetype == "Admin") {
				echo $_SESSION["adminName"]."<br>";
			}
			elseif ($_SESSION["role"] == "Admin" AND $pagetype == "Professor") {
				echo $_SESSION["adminName"]."<br>";
				echo "(as: ".$_SESSION["instructorName"].")<br>";
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