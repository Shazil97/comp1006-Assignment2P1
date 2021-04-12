<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();}

if (empty($_SESSION['username'])) {
    // if not, go to login and stop the rest of the page execution
    header('location:login.php');
    exit();
}
?>