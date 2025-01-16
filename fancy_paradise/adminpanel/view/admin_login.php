<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Login</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/admin_login.css">
</head>
<body>
	<div class="login">
		<h1>Login</h1>
		<form action="../controller/logincontroller.php" method="POST" align="center">
			<div class="inputfield">
				<span class="material-icons-outlined">portrait</span>
				<input type="text" placeholder="Username" name="username">
			</div>
			<div class="inputfield">
				<span class="material-icons-outlined">lock</span>
				<input type="password" placeholder="Password" name="password">
				<span class="toggle-password material-icons-outlined" onclick="togglePasswordVisibility(this)">visibility_off</span>
			</div>
			<input type="submit" class="btn" name="submit" value="Login">
		</form>
	</div>
	<script>
		function togglePasswordVisibility(icon) {
			var passwordInput = icon.previousElementSibling;
			if (passwordInput.type === 'password') {
				passwordInput.type = 'text';
				icon.innerText = 'visibility';
			} else {
				passwordInput.type = 'password';
				icon.innerText = 'visibility_off';
			}
		}
	</script>
</body>
</html>
