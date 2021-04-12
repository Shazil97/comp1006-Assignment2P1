<?php
$pageTitle = "New Household Item ";
include 'header.php';
include 'Restrict.php';
// initialize $item variable
$category = null;
$category['firstname'] = null;
$category['lastname'] = null;
$category['itemname'] = null;
$category['numberofitem'] = null;
$category['category'] = null;

// check if there's an itemId URL param. If so, fetch this item for edit; if not not, show blank
if (!empty($_GET['categoryId'])) {
    if (is_numeric($_GET['categoryId'])) {
        $categoryId = $_GET['categoryId'];

        try {
            // connect
            include 'db.php';

            // fetch selected item
            $sql = "SELECT * FROM Familyhousehold WHERE categoryId = :categoryId";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
            $cmd->execute();
            $item = $cmd->fetch(); // use fetch for as single record
        }
        catch (exception $e) {
            header('location:error.php');
        }
    }
}

?>

<main class="container">
<h1> Enter new Household item</h1>
<form method="post" action="Save-items.php">
    <fieldset class="form-group">
        <label<label for="firstname">Firstname: </label>
        <input name="firstname" id="firstname" required value="<?php echo $category['firstname']; ?>" />
    </fieldset>
    <fieldset>
        <label<label for="lastname">Lastname: </label>
        <input name="lastname" id="lastname" required value="<?php echo $category['lastname']; ?>" />
    </fieldset>
    <fieldset>
        <label for="itemname">Item name: </label>
        <input name="itemname" id="itemname" required value="<?php echo $category['itemname']; ?>" />
    </fieldset>
    <fieldset>
        <label<label for="numberofitem">Number of items: </label>
        <input name="numberofitem" id="numberofitem" required type="number" min="1" value="<?php echo $category['numberofitem']; ?>"/>
    </fieldset>
    <fieldset>


        <label for="category">Category</label>
        <select name="category" id="category">
            <?php
        //DB connect
            try {
                include 'db.php';
                //Write the query
                $sql = "Select categoryId, category FROM category";
                //Setup the command, excute query &store the data
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $category = $cmd->fetchAll();

                foreach ($category as $category) {
                    echo '<option value="' . $category['categoryId'] . '">' . $category['category'] . '</option>';
                }
                //Disconncet db
                $db = null;
            }
            catch (exception $e) {
    header('location:error.php');
}
            ?>
        </select>

    </fieldset>
    <input type="hidden" name="itemId" id="itemId" value="<?php echo $category['categoryId']; ?>" />
    <button type="save" class="btn btn-dark">Save</button>
</form>
</main>
</body>
</html>




