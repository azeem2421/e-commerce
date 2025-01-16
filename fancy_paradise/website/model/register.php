<?php  

$servername ="localhost";
$username = "root";
$password = "";
$dbname = "fancy_paradise";

$conn = new mysqli($servername, $username, $password, $dbname);


if($conn)
{
	if(isset($_POST['submit']))
{
	if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']))
	{
		$username = $_POST["username"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		//$salt = "fancy_paradise";
		//$password_encrypted = sha1($password.$salt);


		$query = "INSERT INTO tbl_register(username,email,password) 
					VALUES ('$username', '$email','$password')";

		$run = mysqli_query($conn,$query) or die(mysql_error());

		if($run)
		{
			?>
			<script>
				alert('User Registered Successfully');
			</script>
			<?php
		}
		else
		{
			
		?>
			<script>
				alert('User Registration Failed');
			</script>
<?php
		}
	}
	else
	{
		echo "all fields required";
	}
}
}









/*

$servername ="localhost";
$username = "root";
$password = "";
$dbname = "fancy_paradise";

$conn = new mysqli($servername, $username, $password, $dbname);


if($conn)
{
	if(isset($_POST['submit']))
{
	if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']))
	{
		$username = $_POST["username"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$salt = "fancy_paradise";
		$password_encrypted = sha1($password.$salt);


		$query = "INSERT INTO tbl_register(username,email,password) 
					VALUES ('$username', '$email','$password_encrypted')";

		$run = mysqli_query($conn,$query) or die(mysql_error());

		if($run)
		{?>
			<script>
				alert('User Registered Successfully');
			</script>
			<?php
		}
		else
		{
		?>
			<script>
				alert('User Registration Failed');
			</script>
<?php
		}
	}
	else
	{
		echo "all fields required";
	}
}
}



*/






?>





















