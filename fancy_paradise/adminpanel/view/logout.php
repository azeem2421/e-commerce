<?php
	include('../model/connection.php');
?>


<!DOCTYPE html>
<html>
<head>
	<style>
		.logout-page {
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
			background-color: #f5f5f5;
			font-family: Arial, sans-serif;
		}
		
		.logout-message {
			text-align: center;
			font-size: 24px;
			color: #333;
			opacity: 0;
			animation: fadeOut 1s ease-in-out forwards;
		}
		
		@keyframes fadeOut {
			from {
				opacity: 1;
			}
			to {
				opacity: 0;
			}
		}
	</style>
</head>
<body>
	<div class="logout-page">
		<div class="logout-message">
			Logging out...
		</div>
	</div>

	<?php
		// Update the logout details in the user log table
		$logout_datetime = date('Y-m-d H:i:s');
		$logout_status = 'Logged Out';
		$login_user_id = $_SESSION['adminuser_id'];

		// Update the row with the logout details
		$sql = "UPDATE tbl_userlog SET logout_datetime = '$logout_datetime', login_status = '$logout_status' 
				WHERE adminuser_id = '$login_user_id' AND logout_datetime IS NULL";

		mysqli_query($conn, $sql);

		// Destroy the session
		session_destroy();
	?>

	<script>
		setTimeout(function() {
			window.location.href = "admin_login.php";
		}, 1000); // Redirect after 1 second
	</script>
</body>
</html>
