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
  
if (isset($_POST["Roster_ID"])){ //If it is the first time, it does nothing   
  getList();
}
?>

 <body>
  
	<Form name ="form2" Method ="Post" Action ="getStudentList.php?func_name=getList">

	<div class = 'col-xs-3'><INPUT TYPE = "TEXT"  Name ="Roster_ID"></div>
	
	<div class = 'col-xs-1'><INPUT TYPE = "Submit" Name = "Retrieve_By_Rost_ID" VALUE = "Retrieve"></div>
	
<?PHP

function getList(){

include 'DatabaseUtilities.php';
echo "Calling get function";
$the_Roster_Id = $_POST['Roster_ID'];

getStudentList($the_Roster_Id);
//echo $the_Student_List; 
}

?>

  </body>
</html>