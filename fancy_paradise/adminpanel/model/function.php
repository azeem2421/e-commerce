<?php
	function check_login($con)
	{
		if(isset($_SESSION['admin_id']))
		{
			$id = $_SESSION['admin_id'];
			$query = "select * from users where admin_id = '$id' limit 1";

			$result = mysqli_query($con,$query);
			if($result && mysql_num_rows($result) > 0) 
			{
				$user_data = mysql_fetch_assoc($result);
				return $user_data;
			}

		}
	}

	//redirect to login

	header("location:../view/admin_login.php");
	die;
?>