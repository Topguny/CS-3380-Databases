<!DOCtypehtml>
<html>
	<head>
		<meta charset=UTF-8>
		<title>CS 3380 Lab9</title>
		
		<style>
		table, th, td {border: 1px solid black;}
		</style>
	</head>
	<body>
	<a href='http://cs3380.rnet.missouri.edu/~lphzqd/lab9/insert.php'>Insert</a>
	<br>

		<form action = "index.php" method = "POST">
			<br>
			Search Column:
			<br>	
			<input type="radio" name ="column" value = 0 checked="check"> Name<br>
			<input type="radio" name ="column" value = 1> Department<br>
			<input type="radio" name ="column" value = 2> Course ID<br><br>
			

			<input type="submit" name = "search" value = "SEARCH">
			<input type="text" name = "info">

		</form>

		<?php


	if(isset($_POST['search'])){	

		include("../secure/database.php");

		$conn = mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME) or die("Connect Error... " . mysqli_error($conn));

		switch ($_POST['column']){

		case 0:
			$query = 'SELECT * FROM Classes WHERE name LIKE ?';
			break;
		case 1:
			$query = 'SELECT * FROM Classes WHERE department LIKE ?';
			break;
		case 2:
			$query = 'SELECT * FROM Classes WHERE course_id LIKE ?';
			break;
		}

		$info = $_POST['info'] . "%";
		echo "<br><br>";
		if($stmt = mysqli_prepare($conn, $query)){
			mysqli_stmt_bind_param($stmt, "s", $info);
			mysqli_stmt_execute($stmt);			
			mysqli_stmt_bind_result($stmt, $col1, $col2, $col3, $col4, $col5, $col6);
			
			echo "<table><tr><th>Name</th><th>Department</th><th>Course ID</th><th>Start</th>
				<th>End</th><th>Days</th><tr>";	
			while( mysqli_stmt_fetch($stmt))
			{
		
				echo "<tr><td>". $col1 . "</td><td>" . $col2 . "</td><td>" . $col3 . "</td><td>" 
				. $col4 . "</td><td>" . $col5 . "</td><td>" . $col6 . "</td>";
				echo "<td>";	
				echo "<form>";
				echo "<input type='submit' name='update' value='Update'>";
				echo "</form>";
				echo "</td>";

				echo "<td>";	
				echo "<form>";
				echo "<input type='submit' name='delete' value='Delete'>";
				echo "</form>";
				echo "</td>";
				echo "</tr>";

			}
			echo "</table>";
			
			
			mysqli_stmt_close($stmt);
		}
		mysqli_close($conn);
	}	
		?>
	</body>
</html>
