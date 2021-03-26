<!DOCTYPE html>
<!--Melanie Corral MC_Communications-->
<html>
<head>
  	<title>Course Details</title>
  	
  	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  	<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
  	<link rel="stylesheet" href="style.css">
</head>

		<h3>Class Details</h3>
	
		<?php
		//This is the database connection
			require_once 'sign_in.php';

			$conn = mysqli_connect($host, $user, $pass, $db);
			if(!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

			$id = $_GET[id];
			$sql = "SELECT * FROM course_roster where roster_id = $id";
			$result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
			echo"<a href=MC_Comm.php><button>Course List</button></a>";
			while($row = mysqli_fetch_assoc($result)) {
				echo"<table class='details'>";
				echo"<td colspan='4'>Class Details</td>";
				echo" <p>{$row['type']} {$row['class_id']} - {$row['course_name']}</p>";
				echo"<tr><th>Class Number</th>
					<td>{$row['class_id']}</td>
					<th>Career</th>
					<td>{$row['career']}</td></tr>";
				echo"<tr><th>Units</th>
					<td>{$row['units']}</td>
					<th>Dates</th>
					<td>{$row['meeting_start']} to {$row['meeting_end']}</td></tr>";
				echo"<tr><th>Status</th>
					<td>{$row['status']}</td>
					<th>Grading</th>
					<td>{$row['grading']}</td></tr>";
				echo"<tr><th>Class type</th>
					<td>{$row['class_type']}</td>
					<th>Location</th>
					<td>{$row['campus']}</td></tr>";
				
				echo"</table><table>";

				echo"<td colspan='6'>Meeting Information</td>";
				echo"<tr><th>Days & Times</th>
					<th>Room</th>
					<th>Instructor</th>
					<th>Meeting Dates</th></tr>";
				echo"<tr><td>{$row['start_time']}-{$row['end_time']}</td>
					<td>{$row['location']}</td>
					<td>{$row['instructor']}</td>
					<td>{$row['meeting_start']} to {$row['meeting_end']}</td>";
				echo"</tr>";
				echo"<td colspan='6'>Description</td>";
				echo"<tr><td colspan='6'>{$row['description']}</td></tr>";
				echo"</table>";
			
			///////////////////////////////////////////
			
				$id = $_GET[id];
				echo"<form style='left:25px';action='course.php?id=$row[roster_id]' method='post'>
					<input type='submit' name='submit' value='Add Course'/>
					</form>";
				if(isset($_POST['submit'])){
					$id = $_GET[id];
					$SQL = "INSERT INTO schedule(roster_id,course_name,class_id,start_time,end_time,location,instructor,meeting_start,meeting_end) SELECT roster_id,course_name,class_id,start_time,end_time,location,instructor,meeting_start,meeting_end FROM course_roster WHERE roster_id = $id";
					$result = mysqli_query($conn, $SQL) or die("Bad Query: $SQL");
					echo "<script>window.location = 'schedule.php'</script>";
				}
			///////////////////////////////////////////////////////////
				
			}


		?>

</html>