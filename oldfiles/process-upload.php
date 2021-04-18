<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>uploads</title>
</head>
<body>
<h1>Your file is uploaded</h1>
<?php
//filename
$name =$_FILES['myFile']['name'];
echo "Name: $name<br /> ";

$size = $_FILES['myFile']['size'];
echo "Size: $size<br />"; //size is in byte: 1024 bytes = 1kb , size will always be in bytes




$tmp_name = $_FILES['myFile']['tmp_name'];   //It will check the file extension
echo "Tmp Name: $tmp_name<br />";


//$type = $_FILES['myFile']['type'];  type only checks the extension NOT the actual file type, mime content will check actual file type extention
//of a file
$type = mime_content_type($tmp_name);
echo "Type: $type<br />";

//save a copy to the upload folder it will transfer file from one place to another
//we need session to identify each file with a unique name
session_start();
$name = session_id() . "-$name";
move_uploaded_file($tmp_name, "uploads/$name");

?>
</body>
</html>
