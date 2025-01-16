<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login/Register</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="container" id="container">
<div class="form-container sign-up-container">

<form action="register.php" method="post">
    <h1>Create Account</h1>
    <input type="text" name="title" placeholder="Title" required>
    <input type="text" name="first_name" placeholder="First Name" required>
    <input type="text" name="last_name" placeholder="Last Name" required>
    <input type="text" name="address" placeholder="Address" required  style="height: 80px;">
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="telephone_no" placeholder="Telephone Number" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="submit">Register</button>
</form>

</div>
<div class="form-container sign-in-container">
	<form action="login.php" method="post">
		<h1>Login</h1>	
	<input type="email" name="email" placeholder="Email" required>
	<input type="password" name="password" placeholder="Password" required>
	

	<button type="submit" name="login">Login</button>
	</form>
</div>
<div class="overlay-container">
	<div class="overlay">
		<div class="overlay-panel overlay-left">
			<h1>Welcome Back!</h1>
			<p>To keep connected with us please login with your personal info</p>
			<button class="ghost" id="signIn">Login</button>
		</div>
		<div class="overlay-panel overlay-right">
			<h1>Hello, Friend!</h1>
			<p>Enter your details and start your journey with us</p>
			<button class="ghost" id="signUp">Register</button>
		</div>
	</div>
</div>
</div>

<script type="text/javascript">
	const signUpButton = document.getElementById('signUp');
	const signInButton = document.getElementById('signIn');
	const container = document.getElementById('container');

	signUpButton.addEventListener('click', () => {
		container.classList.add("right-panel-active");
	});
	signInButton.addEventListener('click', () => {
		container.classList.remove("right-panel-active");
	});
</script>


</body>
</html>