<?php $pageTitle = "Household List";
include 'header.php';
?>
</head>
<body>
<h1> Enter new Household item</h1>
<form method="post" action="Save-items.php" >
    <fieldset class="form-group">
        <label<label for="firstname">Firstname: </label>
        <input name="firstname" id="firstname"/>
    </fieldset>
    <fieldset>
        <label<label for="lastname">Lastname: </label>
        <input name="lastname" id="lastname"/>
    </fieldset>
    <fieldset>
        <label for="itemname">Item name: </label>
        <input name="itemname" id="itemname"/>
    </fieldset>
    <fieldset>
        <label<label for="numberofitem">Number of items: </label>
        <input name="numberofitem" id="numberofitem" type="number" />
    </fieldset>
    <fieldset>


        <label for="category">Category</label>
        <select name="category" id="category">
            <?php
        //DB connect
       $db = new PDO('mysql:host=172.31.22.43;dbname=Shazil1124389','Shazil1124389','pZYTCNYbba');
       //Write the query
       $sql = "Select categoryId, category FROM category";
      //Setup the command, excute query &store the data
       $cmd =$db->prepare($sql);
       $cmd->execute();
       $category =$cmd->fetchAll();

       foreach ($category as $category){
           echo '<option value="' . $category['categoryId'] . '">' . $category['category'] . '</option>';
        }
       //Disconncet db
            $db =null;
            ?>
        </select>

    </fieldset>

    <button type="save" class="btn btn-dark">Save</button>
</form>
</body>
</html>




