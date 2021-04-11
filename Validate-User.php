<?php
//Log in inputs
$username = $_POST['username'];
$password = $_POST['password'];

//Connect to DB
include 'db.php';

//Query to setup
$sql = "SELECT * FROM USERS WHERE username = :username";
$cmd = $db->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 150);
$cmd->execute();
$user = $cmd->fetch();

// 3-CASE SCENARIO
//If statement to check password and return back the user, otherwise connect to esisting session on the web server

if(!user){
    $db = null;
    header('location:Login.php?invalid=true');
}
else{
    if (password_verify($password, $user['password'])){
    session_start();
    $_SESSION['username'] = $username;

    $db = null;
    header('location:Household-Table.php');

}   //Incase password doesnt match then do this
else {
    $db = null;
    header('location:Login.php?invalid=true');
   }
}
?>