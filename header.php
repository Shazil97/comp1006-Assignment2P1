<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Household Items || <?php echo $pageTitle; ?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />

    <!-- link to custom js file to use delete confirmation function -->
    <script type="text/javascript" src="js/scripts.js" defer></script>

    <!-- bootstrap js for css animations -->
    <script type="text/javascript" src="js/bootstrap.min.js" defer></script>


                              <!--JAVA Script for sortable-->
    <!--table sorting from https://www.kryogenix.org/code/browser/sorttable/ -->
    <script type ="text/javascript" src="js/sorttable.js" defer></script>

</head>
<body>
<!-- Bootstrap navbar from https://getbootstrap.com/docs/5.0/components/navbar/#nav -->
<nav class="navbar navbar-dark bg-dark">
    <!-- Navbar content -->
</nav>

<nav class="navbar navbar-dark bg-primary">
    <!-- Navbar content -->
</nav>

<nav class="navbar navbar-expand-lg navbar-expand-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="Index.php">Household Items</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="Household-Table.php">Household List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Household-items.php" method="post" action="Save-items.php">Add new</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="category-details.php" method="post" action="save-category">Add new Category</a>
                </li>

            </ul>
            <ul class="navbar-nav ms-auto">
                <!--IF ELSE Statement for user authentication either it will see 2 options LOGIN AND REGISTER-->
               <?php
                session_start();
               if (empty($_SESSION['username'])){
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="Register.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Login.php">Login</a>
                </li>
                <?php
                }
                else{
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo $_SESSION['username']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Logout.php">Logout</a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>

