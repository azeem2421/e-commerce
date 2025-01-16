<?php
include('../controller/login_check.php');
include('../model/connection.php');

if (!isset($_SESSION)) {
    session_start();
}


// Fetch the modules with relevant access control based on the user's role
$roleId = $_SESSION['role_id'];
$sql = "SELECT m.module_id, m.name, mr.role_id
          FROM tbl_module_role AS mr
          INNER JOIN tbl_module AS m ON mr.module_id = m.module_id
          WHERE mr.role_id = $roleId";
$res = mysqli_query($conn, $sql);
$modules = mysqli_fetch_all($res, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Fancy Paradise Dashboard</title>
	<link rel="icon" href="assets/logo.jpg" type="image/x-icon"> 

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">  

	<link rel="stylesheet" href="../view/css/index.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">  
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/b-2.2.3/b-html5-2.2.3/date-1.1.2/r-2.3.0/datatables.min.css"/> 
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/b-2.2.3/b-html5-2.2.3/date-1.1.2/r-2.3.0/datatables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/tabletools/2.2.4/css/dataTables.tableTools.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  		<script>
            document.addEventListener("DOMContentLoaded", function() {
                var currentUrl = window.location.href;
                var navigationItems = document.querySelectorAll("#navigation .btn");

                navigationItems.forEach(function(item) {
                    if (item.href === currentUrl) {
                        item.classList.add("active");
                    }
                });
            });
        </script>



	
	
</head>
<body>

	<div class="container">
		<aside>
			<div class="top">
			
				
				

				<div class="navigation" id="navigation">
					<a class="dashlogo" href="dashboard.php">
					<img src="assets/logo.jpg" alt="Logo" width="131" height="131">
					</a>

					<div class="user-info">
					<span class="material-icons-outlined">account_box</span>   
						<?php echo $_SESSION['firstname']; ?>
						<?php echo $_SESSION['lastname']; ?>
					</div>

					
					<a class="btn" href="dashboard.php">
					<img src="assets/Module_images/dashboard.png" width="32" height="32">
					<h3>Dashboard</h3>
					</a>

					
					<?php foreach ($modules as $module) : ?>
						<?php
						$moduleSql = "SELECT image FROM tbl_module WHERE module_id = " . $module['module_id'];
						$moduleRes = mysqli_query($conn, $moduleSql);
						$moduleRow = mysqli_fetch_assoc($moduleRes);
						$module_image = $moduleRow['image'];
						?>
						<a class="btn" href="<?php echo $module['name'] . '.php'; ?>">
							<img src="<?php echo SITEURL; ?>adminpanel/view/assets/Module_images/<?php echo $module_image; ?>" alt="<?php echo $module_image; ?>" width="32" height="32">
							<h3><?php echo $module['name']; ?></h3>
						</a>
					<?php endforeach; ?>




                <!-- End of navigation items -->
           

					<a class="btn" href="logout.php">
						<span class="material-icons-outlined">logout</span>
						<h3>Logout</h3>
					</a>
				</div>

			</div>	
		</aside>

