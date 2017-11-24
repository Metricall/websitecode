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
    UpdateInstr();
}
?>

<body>

<Form name ="form2" Method ="Post" Action ="UpdateInstID.php?func_name=UpdateInstr">

<div class = 'col-xs-3'><INPUT TYPE = "TEXT"  Name ="Rost_ID"></div>
<div class = 'col-xs-3'><INPUT TYPE = "TEXT"  Name ="Instructor_ID"></div>
<div class = 'col-xs-3'><INPUT TYPE = "TEXT"  Name ="First_Name"></div>
<div class = 'col-xs-3'><INPUT TYPE = "TEXT"  Name ="Last_name"></div>

<div class = 'col-xs-1'><INPUT TYPE = "Submit" Name = "Update Instr_ID" VALUE = "Update"></div>

<?PHP
function UpdateInstr(){
    include 'DatabaseUtilities.php';
    $the_Roster_Id = $_POST['Rost_ID'];
    $the_Inst = $_POST['Instructor_ID'];
    $the_First_Name = $_POST['First_Name'];
    $the_Last_Name = $_POST['Last_Name'];
    echo "Calling function";
    UpdateInstID($the_Roster_Id, $the_Instructor_ID, $the_First_Name, $the_Last_Name);
    
}
?>

</body>
</html>
