<!DOCTYPE html>

<html>

	<head>
		<meta charset=UTF-8>
		<title>CS 3380 Lab 9 Insert</title>

	<style>
		p {
			margin: 0;
		}

	</style>

	</head>
	<body>

	<a href='http://cs3380.rnet.missouri.edu/~lphzqd/lab9/index.php'>Home</a>
		<form method="post" action="./insert.php">


		<p>Name</p>
		<input type="text" name="name">
		<p>Department</p>
		<input type="text" name="department">
		<p>Course ID</p>
		<input type="text" name="course_id">

		<br>
		<br>

		<p>Start Time</p>
		<select name="start">
			<option value="08:00:00">8:00</option>
			<option value="09:00:00">9:00</option>
			<option value="09:30:00">9:30</option>
			<option value="10:00:00">10:00</option>
			<option value="10:30:00">10:30</option>
			<option value="11:00:00">11:00</option>
			<option value="11:30:00">11:30</option>
			<option value="12:00:00">12:00</option>
			<option value="1:00:00">1:00</option>
			<option value="2:00:00">2:00</option>
		</select>

		<br>
		<br>

		<p>End Time</p>
		<select name="end">
			<option value="08:50:00">8:50</option>
			<option value="09:50:00">9:50</option>
			<option value="09:30:00">9:30</option>
			<option value="10:15:00">10:15</option>
			<option value="10:30:00">10:30</option>
			<option value="10:05:00">10:50</option>
			<option value="11:50:00">11:30</option>
			<option value="1:15:00">1:15</option>
			<option value="1:30:00">1:30</option>
			<option value="2:50:00">2:50</option>
		</select>

		<br>
		<br>

		<p>Days</p>
		<select name="days">
			<option value="MWF">MWF</option>
			<option value="MW">MW</option>
			<option value="TR">TR</option>
			<option value="M">M</option>
			<option value="T">T</option>
			<option value="W">W</option>
			<option value="R">R</option>
			<option value="F">F</option>
		</select>

		<br>
		<br>

		<input type="submit" name="submit" value="go">


</form>
<?php

	if(isset($_POST['submit'])){
        
    include("../secure/database.php");

	$mysqli = mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME) or die("Connect Error... " . mysqli_error($conn));
        
    $query = "SELECT * FROM Classes WHERE `name`=? AND `department`=? AND `course_id`=?";
    $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($query))
    {
        exit();
    }
    $stmt->bind_param("sss", $_POST['name'], $_POST['department'], $_POST['course_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $exists = $result->num_rows;

    if($exists == 0){
	$sql = "INSERT INTO Classes (name, department, course_id, start, end, days) VALUES (?, ?, ?, ?, ?, ?)";

	if($stat = mysqli_prepare($mysqli, $sql)) {

	mysqli_stmt_bind_param($stat, "ssssss", htmlspecialchars($_POST["name"]), $_POST["department"], $_POST["course_id"], $_POST["start"], $_POST["end"], $_POST["days"] ) or die ("Error binding parameter");
	if(mysqli_stmt_execute($stat)){
		echo "Class successfully inserted";
	}
	else{
		echo "Class insertion error";
	}
	}
    }
	else{
		echo"That Class already exists";
	}
	

	$stmt->close();
	$mysqli->close();
	}


		?>
		</body>

</html>
