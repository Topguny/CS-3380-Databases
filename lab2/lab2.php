<!DOCTYPE html>
<html>
	<head>
		<title>Lab 2</title>
	</head>
	<body>
		<form action="lab2.php" method="POST">
			Name:
				<input name = "name" type = "text"></input>
			<br></br>
			Major:
			<br></br>
				<input name = "major" value = "Computer Science" type = "radio"></input>
			Computer Science
			<br></br>
				<input name = "major" value = "other" type = "radio"></input>
			Other
			<br></br>
			Year:
				<select name = "year">
					<option value = Freshman>Freshman</option>
					<option value = Sophmore>Sohpmore</option> 
					<option value = Junior>Junior</option> 
					<option value = Senior>Senior</option> 

				</select>
				
			<br></br>
				<input name="submit" value="Submit" type="submit"></input>
		</form>
	

<?php
	if(isset($_POST['submit'])){
		echo $_POST['name']. "<br>";
		echo $_POST['major']. "<br>";
		echo $_POST['year']. "<br>";
	}
?>
</body>
</html>