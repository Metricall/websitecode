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
  
if (isset($_POST["F_Name"])){ //If it is the first time, it does nothing   
  submitInstName();
}
?>

 <body>
  
	<Form name ="form2" Method ="Post" Action ="getInstructorIDByName.php?func_name=submitInstName">

	<div class = 'col-xs-3'><INPUT TYPE = "TEXT"  Name ="F_Name"></div>
	<div class = 'col-xs-3'><INPUT TYPE = "TEXT"  Name ="L_Name"></div>
	
	<div class = 'col-xs-1'><INPUT TYPE = "Submit" Name = "Submit_Inst_Name" VALUE = "Retrieve"></div>
	
<?PHP
function submitInstName(){
include 'DatabaseUtilities.php';
$the_Fname = $_POST['F_Name'];
$the_Lname = $_POST['L_Name'];
$the_Name = getInstructorIDByName($the_Fname, $the_Lname);
echo $the_Name;
}
?>

  </body>
</html>