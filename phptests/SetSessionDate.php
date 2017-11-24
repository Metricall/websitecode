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

if (isset($_POST["Session_ID"])){ //If it is the first time, it does nothing
    SubmitSessionDate();
}
?>

<body>

<Form name ="form2" Method ="Post" Action ="SetSessionDate.php?func_name=SubmitSessionDate">

<div class = 'col-xs-3'><INPUT TYPE = "TEXT"  Name ="Session_ID"></div>
<div class = 'col-xs-3'><INPUT TYPE = "TEXT"  Name ="Date"></div>

<div class = 'col-xs-1'><INPUT TYPE = "Submit" Name = "Set_Session_Date" VALUE = "Update"></div>

<?PHP
function SubmitSessionDate(){
    include 'DatabaseUtilities.php';
    $the_Session_Id = $_POST['Session_ID'];
    $the_Date = $_POST['Date'];
    echo "Calling function";
    SetSessionDate($the_Session_Id, $the_Date);
    
}
?>

</body>
</html>
