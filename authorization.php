
<?php


if (session_status() == PHP_SESSION_NONE) {
    session_start(); // - now called in header.php otherwise
}

// check if this user's username is stored in a session variable
if (empty($_SESSION['username'])) {
    // if not, go to login and stop the rest of the page execution
    header('location:login.php');
    exit();
}
?>