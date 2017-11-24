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
  
if (isset($_POST["Location_ID"])){ //If it is the first time, it does nothing   
  getSessionList();
}
?>

 <body>
  
	<Form name ="form2" Method ="Post" Action ="getSessionList.php?func_name=getSessionList">

	<div class = 'col-xs-3'><INPUT TYPE = "TEXT"  VALUE = "Enter Location ID" Name ="Location_ID"></div>
	
	<div class = 'col-xs-1'><INPUT TYPE = "Submit" Name = "Retrieve_Session_List_Loc" VALUE = "Retrieve Session List"></div>
	
<?PHP

function getSessionList(){

include 'DatabaseUtilities.php';
$the_Location_ID = $_POST['Location_ID'];
$sessionArray = getSessionListByLoc($the_Location_ID);
$arrlength = count($sessionArray);
echo "<br>";
for($i = 0; $i <= $arrlength; $i++) {
   echo $sessionArray[$i][0];
   echo "<br>";
} 
}

?>

  </body>
</html>
