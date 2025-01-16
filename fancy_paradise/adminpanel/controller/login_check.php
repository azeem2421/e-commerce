<?php
	session_start();

	if (!isset($_SESSION['adminuser_id'])) 
	
	{
		echo '<script type="text/javascript">'; 
		echo 'alert("PLEASE LOGIN TO ACCESS DASHBOARD");'; 
		echo 'window.location.href = "admin_login.php";';
		echo '</script>';
		exit();
	}
?>