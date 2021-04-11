<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saved Category </title>
</head>
<body>
<?php
include "header.php";
?>
<?php
$category = $_POST['category'];
$ok = true;

if (empty($category)) {
    echo 'Category name is required';
    $ok = false;
}

if($ok){
    include "db.php";

    $sql = "INSERT INTO category (categoryId) VALUES (:category)";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':category', $category, PDO::PARAM_STR, 50);

    $cmd->execute();
    $db = null;

    echo "<h1>Your Category has been Saved</h1>";

}
?>

</body>
</html>
