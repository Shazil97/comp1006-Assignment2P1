
<?php
$pageTitle = "Registring...";
include 'header.php';

$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;

//Validation of Inputs
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


if ($ok) {

     //DB Connection
    include 'db.php';

    //Validator for username to check whether it already exsist or not
    $sql = "SELECT userId FROM USERS WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 150);
    $cmd->execute();
    $user = $cmd->fetch();

    //IF statement fro already exsisting user
    if ($user) {
        echo '<p class="alert-secondary">This User Already Exists</p>';
        /*
        $db = null;
        exit(); //to terminate the IF loop */
    }
   else {
       //Inserting statment
       $sql = "INSERT INTO USERS (username, password) VALUES (:username, :password)";
       $cmd = $db->prepare($sql);

       //Hashing of a password
       $password = password_hash($password, PASSWORD_DEFAULT);

       //Connecting columns and rows in db
       $cmd->bindParam(':username', $username, PDO::PARAM_STR, 150);
       $cmd->bindParam(':password', $password, PDO::PARAM_STR, 200);
       //$cmd->bindParam(':ConfirmPassword', $confirm,PDO::PARAM_STR, 200);

       $cmd->execute();

       echo '<h1>Your Registration has been Saved</h1><p>Click <a href="Login.php">Login</a> to enter the site</p>';

   }
    $db = null;

}
?>
  <style>
      h1 {
          color: #0d6efd;
          font-style: inherit;
      }
  </style>
</body>
</html>
