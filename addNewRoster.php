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
 <?php
  
if (isset($_POST["Rost_ID"])){ //If it is the first time, it does nothing   
  submitRostInfo();
}
?>

 <body>
  
	<Form name ="form2" Method ="Post" Action ="addNewRoster.php?func_name=submitRostInfo">

	<div class = 'col-xs-3'><INPUT TYPE = "TEXT"  Value = "Roster ID" Name ="Rost_ID"></div>
	<div class = 'col-xs-3'><INPUT TYPE = "TEXT"  Value = "Instructor ID" Name ="Instructor_ID"></div>
	<div class = 'col-xs-3'><INPUT TYPE = "TEXT"  Value = "Location ID" Name ="Loc_ID"></div>
	
	<div class = 'col-xs-1'><INPUT TYPE = "Submit" Name = "Submit_New_Rost" VALUE = "Submit"></div>
	
<?PHP
function submitRostInfo($the_Roster_ID, $the_Instructor_ID, $the_LocationID){
include 'DatabaseUtilities.php';
$the_Rost_ID = $_POST['Rost_ID'];
$the_Instructor_ID = $_POST['Instructor_ID'];
$the_Loc_ID = $_POST['Loc_ID'];
addNewRoster($the_Rost_ID, $the_Instructor_ID, $the_Loc_ID);
}
?>

  </body>
</html>