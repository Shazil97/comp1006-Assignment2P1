<!DOCTYPE html>
<html>
<head>
    <title>Database Connection</title>
</head>
<body>
<?php

 $db = new PDO('mysql:host=172.31.22.43;dbname=Shazil1124389','Shazil1124389','pZYTCNYbba');
if (!$db)  {
    echo 'could not connect';
}
else {
    echo 'connected to the database';
}
$db = null;
?>
</body>
</html>
?>
</body>
</html>
