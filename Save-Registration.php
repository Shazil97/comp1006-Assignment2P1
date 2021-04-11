<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving...</title>
</head>
<body>

<?php
$username = $_POST['UserName'];
$password = $_POST['Password'];
$confirm = $_POST['ConfirmPassword'];
$ok = true;

// validate inputs
if (empty($username)) {
    echo 'Username is required<br />';
    $ok = false;
}

if (empty($password)) {
    echo 'Password is required<br />';
    $ok = false;
}

if ($password != $confirm) {
    echo 'Password should match to the given Password <br />';
    $ok = false;
}
// save if valid
if ($ok) {

    include 'db.php';
    $sql = "INSERT INTO USERS (username, password) VALUES (:username, :password)";
    $cmd = $db->prepare($sql);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $cmd->bindParam(':UserName', $username, PDO::PARAM_STR, 150);
    $cmd->bindParam(':Password', $password, PDO::PARAM_STR, 200);
    //$cmd->bindParam(':ConfirmPassword', $confirm,PDO::PARAM_STR, 200);
    $cmd->execute();
    $db = null;

// confirmation
    echo '<h1>Registration is Saved</h1><p>Click <a href="Login.php">Login</a> to enter the site</p>';
}
?>

</body>
</html>
