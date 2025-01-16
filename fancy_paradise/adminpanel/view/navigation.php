<?php
	include('../model/connection.php');
	include('../controller/login_check.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dashboard</title>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"
      rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">  


	<link rel="stylesheet" href="../view/css/navigation.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	
</head>
<body>

	<div class="container">
		<aside>
			<div class="top">
			
				
				

				<div class="navigation" id="navigation">
					<a class="btn active" href="dashboard.php">
						<span class="material-icons-outlined">space_dashboard</span>
						<h3>Dashboard</h3>
					</a>

					<a class="btn" href="category.php">
						<span class="material-icons-outlined">category</span>
						<h3>Categories</h3>
					</a>					

					<a class="btn" href="products.php">
						<span class="material-icons-outlined">inventory_2</span>
						<h3>Products</h3>
					</a>

					<a class="btn" href="orders.php">
						<span class="material-icons-outlined">list_alt</span>
						<h3>Orders</h3>
					</a>

					<a class="btn" href="messages.php">
						<span class="material-icons-outlined">mail_outline</span>
						<h3>Messages</h3>
					</a>

					<a class="btn" href="reports.php">
						<span class="material-icons-outlined">report</span>
						<h3>Reports</h3>
					</a> 

					<a class="btn" href="users.php">
						<span class="material-icons-outlined">account_box</span>
						<h3>Users</h3>
					</a>

					<a class="btn" href="logout.php">
						<span class="material-icons-outlined">logout</span>
						<h3>Logout</h3>
					</a>
				</div>

			</div>	
		</aside>

<script type="text/javascript">
	
	
</script>