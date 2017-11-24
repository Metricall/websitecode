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
    submitcoursename();
}
?>

<body>

<Form name ="form2" Method ="Post" Action ="SetCourseName.php?func_name=submitcoursename">

<div class = 'col-xs-3'><INPUT TYPE = "TEXT"  Name ="Rost_ID"></div>
<div class = 'col-xs-3'><INPUT TYPE = "TEXT"  Name ="Course_Name"></div>

<div class = 'col-xs-1'><INPUT TYPE = "Submit" Name = "Set_Course_Name" VALUE = "Update"></div>

<?PHP
function submitcoursename(){
    include 'DatabaseUtilities.php';
    $the_Roster_Id = $_POST['Rost_ID'];
    $the_Student_List = $_POST['Course_Name'];
    echo "Calling function";
    setCourseName($the_Roster_Id, $the_Course_Name);
    
}
?>

</body>
</html>
