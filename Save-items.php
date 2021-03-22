<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Save House hold Item</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
    <!--
    <style>
        body{
            background-color: #6a1a21;
            color: white;
        }
    </style>
    -->
</head>
<body>
<?php
//Store the form inputs in variables (optional but reduces syntax errors)
$firstname = $_POST['firstname'];
$lastname= $_POST['lastname'];
$itemname = $_POST['itemname'];
$numberofitem = $_POST['numberofitem'];
$category = $_POST['category'];
$ok = true;

//validatation inputs before saving

if (empty(trim($firstname))) {
    echo 'firstname is required<br />';
    $ok = false;
}

if (empty($lastname)) {
    echo 'lastname is required<br />';
    $ok = false;
}

if (empty($numberofitem)) {
    echo 'number of item is required<br />';
    $ok = false;
}
else {
    if (!is_numeric($numberofitem)) {
        echo 'number of item must be a number<br />';
        $ok = false;
    }
    else {
        if ($numberofitem < 1) {
            echo 'number of items must be greater than zero';
            $ok = false;
        }
    }
}
if (empty($category)) {
    echo 'category is required<br />';
    $ok = false;
}


//Database Conection
$db = new PDO('mysql:host=172.31.22.43;dbname=Shazil1124389','Shazil1124389','pZYTCNYbba');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = "INSERT INTO Familyhousehold (firstname, lastname, itemname, numberofitem, category) 
        VALUES (:firstname, :lastname, :itemname, :numberofitem, :category)";

    //Populate the INSERT with variables using a Command variable to prevent SQL Injections
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':firstname', $firstname, PDO::PARAM_STR, 50);
    $cmd->bindParam(':lastname', $lastname, PDO::PARAM_STR, 50);
    $cmd->bindParam(':itemname', $itemname, PDO::PARAM_STR, 50);
    $cmd->bindParam(':numberofitem',$numberofitem,PDO::PARAM_INT);
    $cmd->bindParam(':category',$category,PDO::PARAM_STR,50);

//Save & Excute
$cmd->execute();


$db = null;
echo "<h1>Your new item has been saved</h1>";

?>

</body>
</html>