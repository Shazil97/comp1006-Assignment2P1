<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script>
        function confirm(){
            return confirm("Are you sure!");
        }
    </script>
</head>

<?php $pageTitle = "Household List";
include 'header.php';
?>
<h1>Household Item List</h1>

<?php
if(!empty($_SESSION['username'])){
    echo '<a href="Household-items.php">Add Items</a>';
}
// 1. Connect to the db.
try {
    include 'db.php';

//2. SQL select query
    $sql = "SELECT * FROM Familyhousehold";


//Excution command
    $cmd = $db->prepare($sql);
    $cmd->execute();
    $Familyhousehold = $cmd->fetchAll();

// Use a foreach loop to iterate (cycle) through all the values in the $items variable.
// Inside this loop, use an echo command to display the name of each item.
//  See https://www.php.net/manual/en/control-structures.foreach.php for details.
// start an HTML table for formatting BEFORE the foreach loop

    echo '<table class="table table-hover table-secondary"><thead><th>First Name<th>Last Name</th><th>Item Name</th></TH><th>Number of Items</th><th>Category</th>';
    //use session to restrict the user
    if (!empty($_SESSION['username'])){
         echo '<th>Actions</th>';
    }
    echo '<th>Photos</th></thead>';

    foreach ($Familyhousehold as $indFamilyhousehold) {
        echo '<tr><td>' . $indFamilyhousehold['firstname'] . '</td>
        <td>' . $indFamilyhousehold['lastname'] . '</td>
        <td>' . $indFamilyhousehold['itemname'] . '</td>
        <td>' . $indFamilyhousehold['numberofitem'] . '</td>
        <td><a href="Household-items.php?categoryId=' . $indFamilyhousehold['categoryId'] .
            '">' . $indFamilyhousehold['category'] . '</a></td>';
        if (!empty($_SESSION['username'])){
         echo '<td><a href="Household-items.php?categoryId=' . $indFamilyhousehold['categoryId'] .
            '" class="btn btn-outline-secondary">Edit</a>&nbsp;
                <a href="Delete.items.php?categoryId=' . $indFamilyhousehold['categoryId'] .
            '" class="btn btn-outline-danger" title="Delete"
                onclick="return confirm();">Delete</a></td>
           <td>'. $indFamilyhousehold['photo'] . '</td></tr>';
                }
        echo'</tr>';

    }


    // close the table
    echo '</table>';
    $db = null;
}
catch (exception $e){
    header('location:error.php');
}
?>
</body>
</html>
<!--

//FetchAll method
$categoryId = $cmd->fetchAll();

echo '<table class="table table-striped table-light"><thead><th>Firstname<th>Item name</th><th>Number of items</th></TH><th>Category</th></thead>';

foreach ($categoryId as $categoryId){

echo '<tr><td>' . $categoryId['firstname'] . '</td>
    <td><a href="Household-items.php?categoryId=' . $categoryId['itemname'] .
    '">' . $categoryId['numberofitem'] . '</a></td>
     <td>' . $categoryId['category'] . '</td>
      <td><a href="Household-items.php?categoryId=' . $categoryId['categoryId'];

}


echo '</table>';
*/

// 6. Disconnect from the database
-->