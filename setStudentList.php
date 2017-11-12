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
  submitList();
}
?>

 <body>
  
	<Form name ="form2" Method ="Post" Action ="setStudentList.php?func_name=submitList">

	<div class = 'col-xs-3'><INPUT TYPE = "TEXT"  Name ="Rost_ID"></div>
	<div class = 'col-xs-3'><INPUT TYPE = "TEXT"  Name ="Student_List"></div>
	
	<div class = 'col-xs-1'><INPUT TYPE = "Submit" Name = "Submit_Rost_ID" VALUE = "Update"></div>
	
	<?PHP

function submitList(){

include 'DatabaseUtilities.php';

$the_Roster_Id = $_POST['Rost_ID'];
$the_Student_List = $_POST['Student_List'];
echo "Calling function";
setStudentList($the_Roster_Id, $the_Student_List);
	
}

?>

  </body>
</html>