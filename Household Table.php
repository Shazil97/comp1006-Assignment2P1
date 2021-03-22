<?php $pageTitle = "Household List";
include 'header.php';
?>
<h1>Household-item List</h1>
<a href="Household-items.php"> Add an item</a>
<?php
// 1. Connect to the db.
$db = new PDO('mysql:host=172.31.22.43;dbname=Shazil1124389','Shazil1124389','pZYTCNYbba');

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

echo '<table class="table table-striped table-light"><thead><th>First Name<th>Last Name</th></th><th>Item Name</th></TH><th>Number of Items</th><th>Category</th></thead>';

    foreach ($Familyhousehold as $indFamilyhousehold)
    {
        echo '<tr><td>' . $indFamilyhousehold['firstname'] . '</td>
        <td>' . $indFamilyhousehold['lastname'] . '</td>
        <td>' . $indFamilyhousehold['itemname'] . '</td>
        <td>' . $indFamilyhousehold['numberofitem'] .'</td>
        <td>' . $indFamilyhousehold['category'] .'</td></tr>';

    }

    // close the table
    echo '</table>';
$db = null;
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