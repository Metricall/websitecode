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
	include 'session_functions.php';
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
	<div class = 'col-xs-7'><h2>Create a Session</h2></div>
	</div><br>
	<div class = 'row' id = 'lastform'>
	<div class = 'col-xs-3'></div>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div class = 'col-xs-2'>Location </div>
	<div class = 'col-xs-1'>
	<select name="loc">
		<?php
			$locations=getLocationList();
			$defaultloc = getRosterLocation($_SESSION["rid"]);
			$locations=explode(',',$locations);
			foreach($locations as $l) {
				echo "<option value='".$l."'".(($defaultloc == $l) ? ' selected="selected"' : '').">";
				echo getLocationBuilding($l)." ".getLocationRoom($l)."</option>";
			}
		?>
	</select>
	</div>
	</div><br>
	<div class = 'row' id = 'lastform'>
	<div class = 'col-xs-3'></div>
	<div class = 'col-xs-2'>Date</div>
	<div class = 'col-xs-7'>
	<div class="container">
    <div class="row">
        <div class='col-sm-3'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker2'>
                    <input type='text' class="form-control" name="date" />
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
	</div><br>
	<div class = 'row' id = 'lastform'>
	<div class = 'col-xs-3'></div>
	<div class = 'col-xs-2'>From</div>
	<div class = 'col-xs-7'>
	<div class="container">
    <div class="row">
        <div class='col-sm-3'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" name="from" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
							$('#datetimepicker1').datetimepicker({
                    format: 'LT'
                });
            });
        </script>
    </div>
</div>
	</div>
	</div><br>
	<div class = 'row' id = 'lastform'>
	<div class = 'col-xs-3'></div>
	<div class = 'col-xs-2'>To</div>
	<div class = 'col-xs-7'>
	<div class="container">
    <div class="row">
        <div class='col-sm-3'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker3'>
                    <input type='text' class="form-control" name="to" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
							$('#datetimepicker3').datetimepicker({
                    format: 'LT'
                });
            });
        </script>
    </div>
</div>
	</div>
	</div><br>
	<div class = 'row' id = 'sendbutton'>
	<div class = 'col-xs-5'></div>
	<div class = 'col-xs-3'><input type="submit" value="Create"></div>
	</form>
	<?php
		if(isset($_POST["date"]) AND isset($_POST["from"]) AND isset($_POST["to"])) {
			$newSID = newsession($_SESSION["rid"], $_POST["loc"], $_POST["date"], $_POST["from"], $_POST["to"]);
			if($newSID == false)
				echo "Error: unable to create session.";
		}
	?>
	</div><br><br><br>	
	<div align='center'>
	<table border='1' id = 'roster'>
	<br>
	<h2>Existing Sessions</h2>
	<?php 
		if(isset($_SESSION["rid"])) 
			sessionlist($_SESSION["rid"], false);
	?>
</table>
<script type="text/javascript" src="datepicker.js"></script> 
</div>
	<?php include 'footer.php'; ?>
  </body>
</html>