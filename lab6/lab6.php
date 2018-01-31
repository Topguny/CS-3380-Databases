<html>
<body>

<form action="" method="POST" class="col-md-4 col-md-offset-5">
    <select name="class">
        <option value='1'>All Records</option>
        <option value='2'>Start Time</option>
        <option value='3'>Math Department</option>
        <option value='4'>MWF Classes</option>
        <option value='5'>Class Length</option>    
    </select>
    <input type="submit" name="submit" class="btn" value="Execute"/>
</form>
  
</body>
</html>
<?php
include("../secure/database.php");
    $mysqli = mysqli_connect(HOST,USERNAME,PASSWORD,DBNAME) or die("Connect Error" . mysqli_error($mysqli));

    if(isset($_POST['submit'])) {
        if ($_POST['class'] == 1){
            $sql = "SELECT * FROM `Classes`;";
            $result = $mysqli->query($sql);
            echo"<table>";
            while($fieldInfo = mysqli_fetch_field($result)){
                echo "<th>" .  $fieldInfo->name . "</th>";
            }
            while($row = $result->fetch_array(MYSQLI_NUM)){
                echo "<tr>";
                foreach($row as $data){
                    echo "<td>" . $data . "</td>";
                }
                echo "</tr>";
            }
        }
        if ($_POST['class'] == 2){
            $sql = "SELECT `start` FROM `Classes`;";
            $result = $mysqli->query($sql);
            echo"<table>";
            while($fieldInfo = mysqli_fetch_field($result)){
                echo "<th>" .  $fieldInfo->name . "</th>";
            }
            while($row = $result->fetch_array(MYSQLI_NUM)){
                echo "<tr>";
                foreach($row as $data){
                    echo "<td>" . $data . "</td>";
                }
                echo "</tr>";
            }
        }
        if ($_POST['class'] == 3){
            $sql = "SELECT `Name` FROM `Classes` WHERE `department` = 'Math department';";
            $result = $mysqli->query($sql);
            echo"<table>";
            while($fieldInfo = mysqli_fetch_field($result)){
                echo "<th>" .  $fieldInfo->name . "</th>";
            }
            while($row = $result->fetch_array(MYSQLI_NUM)){
                echo "<tr>";
                foreach($row as $data){
                    echo "<td>" . $data . "</td>";
                }
                echo "</tr>";
            }
        }
        if ($_POST['class'] == 4){
            $sql = "SELECT `Name`,`course_id` FROM `Classes` WHERE `days` = 'MWF';";
            $result = $mysqli->query($sql);
            echo"<table>";
            while($fieldInfo = mysqli_fetch_field($result)){
                echo "<th>" .  $fieldInfo->name . "</th>";
            }
            while($row = $result->fetch_array(MYSQLI_NUM)){
                echo "<tr>";
                foreach($row as $data){
                    echo "<td>" . $data . "</td>";
                }
                echo "</tr>";
            }
        }
        if ($_POST['class'] == 5){
            $sql = "SELECT TIMEDIFF(`end`,`start`) FROM `Classes`;";
            $result = $mysqli->query($sql);
            echo"<table>";
            while($fieldInfo = mysqli_fetch_field($result)){
                echo "<th>" .  $fieldInfo->name . "</th>";
            }
            while($row = $result->fetch_array(MYSQLI_NUM)){
                echo "<tr>";
                foreach($row as $data){
                    echo "<td>" . $data . "</td>";
                }
                echo "</tr>";
            }
        }
    }
    
?>
