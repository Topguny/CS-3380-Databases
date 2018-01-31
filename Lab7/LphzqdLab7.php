<!DOCTYPE html>
<head>
  <title>Register</title>
</head>

<body>
    
<h1>Hello, Please register for an account below...</h1>
<a href="http://cs3380.rnet.missouri.edu/~lphzqd/Lab7/login.php">If you already have an account click here.</a>
    
<form action="" method=POST>
  Name:<br>
  <input type=text name="name" required="required"> <br>
  Pass:<br>
  <input type="text" name="pass" required="required">
  <br><br>
  <input type="submit" name="submit">
</form>

<?php
session_start();
if(isset($_POST['submit'])){
    include("../secure/database.php");
    $mysqli = new mysqli($HOST, $USER, $PASS, $DB);
    if($mysqli->connect_errno){
        echo "Connection failed on line 5";
        exit();
    }
    $query = "SELECT * FROM user WHERE user=?";
    $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($query))
    {
        exit();
    }
    $stmt->bind_param("s", $_POST['name']);
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->num_rows;
    echo "Found: " . $exists;
    if($exists == 0){
        $query = "INSERT INTO user VALUES(?,?)";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            exit();
        }
        $hash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $stmt->bind_param("ss", $_POST['name'], $hash);
        $stmt->execute();
        echo "<hr>User created<br>";
        $_SESSION['name'];
        echo "<a href='http://cs3380.rnet.missouri.edu/~Lphzqd/lab7/sessionAccess.php'";
    } else {
        echo "<hr>User name taken";
        session_destroy();
    }
    $stmt->close();
    $mysqli->close();
}
?>