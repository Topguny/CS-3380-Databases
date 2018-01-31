<!DOCTYPE html>
<html>
<?php session_start(); ?>
<head>
	<meta charset="utf-8">
	<title>Profile</title>
</head>
<body>
<?php echo $_SESSION["username"]; ?>, you have been successfully logged in.
    
<input type="submit" name="logout" value="go">

</body>
</html>

<?php
    if(isset($_POST["submit"])){
    exit();
    echo "<a href='http://cs3380.rnet.missouri.edu/~aardz6/Lab7/LphzqdLab7.php'>Return Home</a>";
    session_destroy();
    }

?>

