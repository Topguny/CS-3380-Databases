<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<title>HW2 Login Page</title>

	<style>
		p {
			margin: 0;
		}
	</style>

</head>
<body>

<h1>Please login below...</h1>


<br><br><br>


<form method="post" action="./login.php">


<p>Username</p>
<input type="text" name="usern">
<br>
<br>

<p>Password</p>
<input type="password" name="pwd">
<br>

<input type="submit" name="submit" value="go">

</form>
</body>
</html>

<?php

session_start();
	
include("../secure/database.php");

if(isset($_POST["submit"])){

$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME) or die("Connect Error... " . mysqli_error($conn));

$username = $_POST["usern"];
$password = $_POST["pwd"];

$query = "SELECT * FROM user WHERE username=? and password=?";
    $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($query))
    {
        exit();
    }
    
    $result = $stmt->get_result($query);
    
    while($fieldInfo = mysqli_fetch_field($result)){
        if (password_hash($_POST["pwd"]) == $fieldInfo->password){
	       $_SESSION["username"] = $username;
	       echo "<a href='http://cs3380.rnet.missouri.edu/~lphzqd/Lab7/sessionAccess.php'";
	       exit;
        }
        else{
	       echo "Invalid Login Credentials.";
            session_destroy();
        }
    }

}

?>






