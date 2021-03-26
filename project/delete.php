<!DOCTYPE HTML>
<!--Melanie Corral MC_Communications-->
<html>
		<?php
		//This will delete the course from the schedule
			require_once 'sign_in.php';

			$conn = mysqli_connect($host, $user, $pass, $db);
			if(!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			$id = $_GET[id];
			$sql = "DELETE FROM schedule WHERE roster_id = $id";
			$result = mysqli_query($conn, $sql) or die("Bad Query: $sql");

			echo "<script>window.location = 'schedule.php'</script>";
		?>
	</html>