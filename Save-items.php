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



                      //Validation Inputs before saving

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



                                   //VALIDATION FOR PHOTOS

if (!empty($_FILES['photo']['name'])) {
    // check that upload is an image (type of image) with file extension
    $type = mime_content_type($_FILES['photo']['tmp_name']);
    if ($type != 'image/jpeg' && $type != 'image/png' && $type != 'image/jpg' && $type != 'image/gif'
        && $type != 'image/docx') {
        echo 'This Photo is Invalid <br />';
        $ok = false;
    }
    else {
        // give file a unique name & save to img/item-uploads with session id
        $photo = session_id() . "-" . $_FILES['photo']['name'];   //Keep the original name
        move_uploaded_file($_FILES['photo']['tmp_name'], "img/item-uploads/$photo");  //move the picture from temperary directory to a img Directory
    }
}
else {     //If there is no photo uploaded we will set this to null
    $photo = $_POST['currentPhoto']; //this will keep existing photo if nothing uploaded
}






//Database Conection
//try {
    include 'db.php';
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if (empty($itemId)) {
        $sql = "INSERT INTO Familyhousehold (firstname, lastname, itemname, numberofitem, category, photo) 
        VALUES (:firstname, :lastname, :itemname, :numberofitem, :category, :photo)";

    }                        //For Editing
    else{
        $sql = "UPDATE Familyhousehold SET firstname = :firstname, lastname = :lastname, itemname = :itemname, numberofitem = :numberofitem,
       category = :category, photo = :photo  WHERE itemId = :itemId";
    }

    //Populate the INSERT with variables using a Command variable to prevent SQL Injections
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':firstname', $firstname, PDO::PARAM_STR, 50);
    $cmd->bindParam(':lastname', $lastname, PDO::PARAM_STR, 50);
    $cmd->bindParam(':itemname', $itemname, PDO::PARAM_STR, 50);
    $cmd->bindParam(':numberofitem', $numberofitem, PDO::PARAM_INT);
    $cmd->bindParam(':category', $category, PDO::PARAM_STR, 50);
    $cmd->bindParam(':photo', $photo, PDO::PARAM_STR,100);

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