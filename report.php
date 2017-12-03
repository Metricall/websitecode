<?php
session_start();
?>
<?php
	include 'DatabaseUtilities.php';
	include 'LoginUtilities.php';
	if (checkLogin()) {
		//not an admin or insturctor
		if ($_SESSION["role"] != "Admin" AND $_SESSION["role"] != "Professor")
			header("Location: logout.php");
		//no roster chosen
		elseif (!isset($_SESSION["rid"]))
			header("Location: professormain.php");
	}
	$pagetype = "Professor";
	include 'report_functions.php';
?>
<!DOCTYPE html>
<!--professor
 -->
<html lang = "en">
  <head>
<script type="text/javascript" src="jquery-3.2.1.min.js"></script> 
<script type="text/javascript" src="moment.min.js"></script> 
   <link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css">
    <link rel = "stylesheet" type = "text/css" href = "mainmetrical.css">
	<script type = "text/javascript" src = "metricalsite.js"></script>
    <title> Professor </title>
    <meta charset = "utf-8">
  </head>
  <body>
	<?php include 'header.php'; ?>
	<br>
	<div class = 'row' id = 'yourclasses'>
	<div class = 'col-xs-5'></div>
	<div class = 'col-xs-7'><h2>Generate Report</h2></div>
	</div><br>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">	
	<div class = 'row' id = 'lastform'>
	<div class = 'col-xs-3'></div>
	<div class = 'col-xs-2'>Start Date</div>
	<div class = 'col-xs-7'>
	<div class="container">
    <div class="row">
        <div class='col-sm-3'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker4'>
                    <input type='text' class="form-control" name="begin" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker4').datetimepicker({
                format: 'MM/DD/YYYY'
            });
            });
        </script>
    </div>
</div>
	</div>
	</div><br>
	
	
	<div class = 'row' id = 'firstform'>
	<div class = 'col-xs-3'></div>
	<div class = 'col-xs-2'>End Date</div>
	<div class = 'col-xs-1'>
	<div class="container">
    <div class="row">
        <div class='col-sm-3'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker2'>
                    <input type='text' class="form-control" name="end" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker2').datetimepicker({
                format: 'MM/DD/YYYY'
            });
            });
        </script>
    </div>
</div>
	</div>
	</div>
	<div class = 'row' id = 'sendbutton'>
	<div class = 'col-xs-5'></div>
	<div class = 'col-xs-3'><input type="submit" value="Create"></div>
	</div>
	</form>
	&nbsp;
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">	
	<div class = 'row' id = 'sendbutton'>
	<div class = 'col-xs-5'></div>
	<input type="hidden" value="yes" name="all">
	<div class = 'col-xs-3'><input type="submit" value="All Sessions"></div>
	</div>
	</form>
	<br><br>
	<?php 
		if(isset($_POST["all"])) {
			reportgen($_SESSION["rid"], true, "doesntmatter", "alsodoesntmatter");
		}
		elseif (isset($_POST["begin"]) AND isset($_POST["end"])) {
			reportgen($_SESSION["rid"], false, $_POST["begin"], $_POST["end"]);
		}
	?>
	<script type="text/javascript" src="datepicker.js"></script>
	<?php include 'footer.php'; ?>
  </body>
</html>