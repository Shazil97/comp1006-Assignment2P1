<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script>
        function confirm() {
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
?>

                                           <!--For SEARCH BAR for KEYWORD & Category-->
                <!--You dont need to specify any method bcz form is already having GET method
                                      Check for search Criteria FOR SEARCH BAR (Validation with Input Form)-->
<?php
$keyword = null;
$categoryId = null;

                 //For Keyword
if (isset($_GET['keyword'])){
//If we have a keyword param value in url
$keyword = $_GET['keyword'];
}

              //For CategoryId
if (isset($_GET['categoryId'])){
//If we have a keyword param value in url
    if (is_null($_GET['categoryId']))
    $categoryId = $_GET['categoryId'];
}
?>
                                                  <!--Category and Keyword Form-->
<section>
    <form action="Household-Table.php">
        <input name="keyword" id="keyword" placeholder="Search Term" value="<?php echo $keyword ?>"> <!--For keyword search-->
        <select name="categoryId" id="categoryId">   <!--for category list-->
            <?php
            include 'db.php';

            //REPEAT THE CODE FOR DROPDOWN MENU FROM household-items
            $sql = "Select categoryId, category FROM category";
            //Setup the command, excute query &store the data
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $category = $cmd->fetchAll();

            foreach ($category as $category) {
                echo '<option value="' . $category['categoryId'] . '">' . $category['category'] . '</option>';
            }
               ?>
        </select>
        <button class="btn btn-primary"> Search </button>
        <a class="btn btn-primary" href="Household-Table.php">Clear</a> <!-- Anchor tag for clear button-->
    </form>
</section>



<?php
// 1. Connect to the db.
//try {
    include 'db.php';


//2. SQL select query
    //  $sql ="SELECT * FROM Familyhousehold";

    $sql = "SELECT Familyhousehold.*, category.category AS category FROM Familyhousehold
           LEFT OUTER JOIN category on Familyhousehold.category = category.categoryId";

    //Validation for  KEYWORD & CATEGORY
    if ($keyword != null) {
        $sql .= " WHERE Familyhousehold.category LIKE :keyword";


        if ($categoryId != null) {
            $sql .= " AND Familyhousehold.categoryId = :categoryId";
        }
    } else {
        if ($categoryId != null) {
            $sql .= " WHERE Familyhousehold.categoryId = :categoryId";
        }
    }

//Excution Command with Keyword and Category BIND PARAM and WILD CARD
    $cmd = $db->prepare($sql);

    if ($keyword != null) {
        $keyword = '%' . $keyword . '%';
        $cmd->bindParam(':keyword', $keyword, PDO::PARAM_STR, 100);
    }

    if ($categoryId != null) {
        $cmd->bindParam(':categoryId', $categoryId, PDO::PARAM_INT, 100);
    }

    //Execute command
    $cmd->execute();
    $Familyhousehold = $cmd->fetchAll();


    //IF Statement to check the input keywords are present or not
    if (!$Familyhousehold) {
        echo '<div class="alert alert-danger"> No items found </div>';
    } else {
        // Use a foreach loop to iterate (cycle) through all the values in the $items variable.
        // Inside this loop, use an echo command to display the name of each item.
        //  See https://www.php.net/manual/en/control-structures.foreach.php for details.
        // start an HTML table for formatting BEFORE the foreach loop

        echo '<table class="table table-hover table-secondary sortable"><thead><th>First Name<th>Last Name</th><th>Item Name</th></TH><th>Number of Items</th><th>Category</th>';

        //use session to restrict the user
        if (!empty($_SESSION['username'])) {
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


            if (!empty($_SESSION['username'])) {
                echo '<td><a href="Household-items.php?categoryId=' . $indFamilyhousehold['categoryId'] .
                    '" class="btn btn-outline-secondary">Edit</a>&nbsp;
                    <a href="Delete.items.php?categoryId=' . $indFamilyhousehold['categoryId'] .
                    '" class="btn btn-outline-danger" title="Delete"
                    onclick="return confirm();">Delete</a></td>
               <td>' . $indFamilyhousehold['photo'] . '</td></tr>';
            }
            echo '</tr>';

        }
        // close the table
        echo '</table>';
    }
    $db = null;
//}
//catch (exception $e){
//    header('location:error.php');
//}
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