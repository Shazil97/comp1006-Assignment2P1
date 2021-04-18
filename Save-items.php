<?php $pageTitle = "Saving...";
include 'header.php';
include 'Restrict.php';
//Store the form inputs in variables (optional but reduces syntax errors)
$firstname = $_POST['firstname'];
$lastname= $_POST['lastname'];
$itemname = $_POST['itemname'];
$numberofitem = $_POST['numberofitem'];
$category = $_POST['category'];
$photo = $_POST['photo'];
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

if (!empty($_FILES['photo']['name'])) {
    // check that upload is an image
    $type = mime_content_type($_FILES['photo']['tmp_name']);
    if ($type != 'image/jpeg' && $type != 'image/png') {
        echo 'Invalid Picture <br />';
        $ok = false;
    }
    else {
        // give file a unique name & save to img/item-uploads
        $photo = session_id() . "-" . $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/$photo");
    }
}
else {
    $photo = null; // keep existing photo if nothing uploaded
}



//Database Conection
//try {
    include 'db.php';
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO Familyhousehold (firstname, lastname, itemname, numberofitem, category, photo) 
        VALUES (:firstname, :lastname, :itemname, :numberofitem, :category, :photo)";

    //Populate the INSERT with variables using a Command variable to prevent SQL Injections
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':firstname', $firstname, PDO::PARAM_STR, 50);
    $cmd->bindParam(':lastname', $lastname, PDO::PARAM_STR, 50);
    $cmd->bindParam(':itemname', $itemname, PDO::PARAM_STR, 50);
    $cmd->bindParam(':numberofitem', $numberofitem, PDO::PARAM_INT);
    $cmd->bindParam(':category', $category, PDO::PARAM_STR, 50);
    $cmd->bindParam(':photo', $photo, PDO::PARAM_STR,50);

//Save & Excute
    $cmd->execute();


    $db = null;
/*}
catch (exception $e){
    header('location:error.php');
}
*/
echo "<h1>Your new item has been saved</h1>";

?>

</body>
</html>