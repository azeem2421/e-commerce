<?php
	include ('../model/connection.php');
	

	$admin_id = $_GET['admin_id']; 

	$sql = "DELETE FROM tbl_adminlogin WHERE admin_id=$admin_id";

	$res = mysqli_query($conn, $sql);


	if($res==true)
	{
		echo '<script type="text/javascript">'; 
		echo 'alert("USER DELETED");'; 
		echo 'window.location.href = "../view/users.php";';
		echo '</script>';
	}
	else
	{
		echo '<script type="text/javascript">'; 
		echo 'alert("FAILED TO DELETE USER");'; 
		echo 'window.location.href = "../view/users.php";';
		echo '</script>';
	}
?>

