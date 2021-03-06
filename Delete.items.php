<?php
$pageTitle = "Deleting...";
include 'header.php';


if (is_numeric($_GET['categoryId'])) {
    // read the itemId from the URL parameter using the $_GET collection
    $categoryId = $_GET['categoryId'];
    try {
        // connect
        include 'db.php';

        // set up & run the SQL DELETE command
        $sql = "DELETE FROM Familyhousehold WHERE categoryId = :categoryId";
        $cmd = $db->prepare($sql);
        $cmd->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $cmd->execute();

        // disconnect
        $db = null;
    }
    catch (exception $e) {
        header('location:error.php');
    }
}

// redirect to the updated items.php page. if no numeric itemId URL param, just reload anyway
//header('Location:HouseholdTable.php');
?>
<h1>Item Deleted</h1>
</body>
</html>