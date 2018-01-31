<?php
session_start();
if(isset($_SESSION['name'])){
    echo $_SESSION['name'] . "<br>";
    echo "<a href='http://cs3380.rnet.missouri.edu/~lphzqd/lab7/profile.php'>Profile</a>";
}
else{
    echo "Session not created yet<br>";
    echo "<a href='http://cs3380.rnet.missouri.edu/~lphzqd/Lab7/LphzqdLab7.php'>Return Home</a>";
}
session_destroy();
?>