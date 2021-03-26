<!DOCTYPE html>
<!--Melanie Corral MC_Communications-->
<html>
<head>
  	<title>Schedule</title>
  	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  	<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
  	<link rel="stylesheet" href="style.css">
</head>
	<h3>Schedule</h3>

		<?php
			//This is the database connection
			require_once 'sign_in.php';

			$conn = mysqli_connect($host, $user, $pass, $db);
			if(!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			$id = $_GET[id];
			$sql = "SELECT * FROM schedule group by roster_id";
			$result = mysqli_query($conn, $sql) or die("Bad Query: $sql");

			
			while($row = mysqli_fetch_assoc($result)) {
				echo"<table>";
				echo"<td colspan='6'>{$row['type']} {$row['class_id']} - {$row['course_name']}</td>";
				echo"<tr><th>Course</th>
					<th>Times</th>
					<th>Room</th>
					<th>Instructor</th>
					<th>Meeting Dates</th>
					<th>View Course</th><tr>";
				echo"<tr><td>{$row['class_id']}</td>
					<td>{$row['start_time']}-{$row['end_time']}</td>
					<td>{$row['location']}</td>
					<td>{$row['instructor']}</td>
					<td>{$row['meeting_start']} to {$row['meeting_end']}</td>";	
				echo"<td><a href=delete.php?id=$row[roster_id]>
					<button>Delete</button></a>";
				echo"</td></tr></table>";		
			}
			echo"<a href=MC_Comm.php><button>Course List</button></a>";
		?>
	

</html>