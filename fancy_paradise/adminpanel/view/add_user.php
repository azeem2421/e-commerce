<?php
	include "index.php";
?>

<style>
	<?php include "css/add_user.css"; ?>
</style>








<main>

	<h1 class="sticky">ADD USER</h1>

	<!------------------------------ User Input Form starts ------------------------------>
	<div>
		<form action="" method="POST" id="addUserForm">
			<table class="add-user-form">
				<tr>
					<td><b>Title:</b></td>
					<td>
						<select name="title" required>
							<option value="">Select Title</option>
							<option value="Mr.">Mr.</option>
							<option value="Ms.">Ms.</option>
							<option value="Mrs.">Mrs.</option>
						</select>
					</td>
				</tr>
				<tr>
					<td><b>First Name:</b></td>
					<td><input type="text" name="firstname" required></td>
				</tr>
				<tr>
					<td><b>Last Name:</b></td>
					<td><input type="text" name="lastname" required></td>
				</tr>
				<tr>
					<td><b>NIC No:</b></td>
					<td>
					<input type="text" name="nic_number" id="nic_number"required>
    				<span id="nic_status" class="status"></span>
						
					</td>
				</tr>
				<tr>
					<td><b>Date of Birth:</b></td>
					<td><input type="text" id="datepicker" name="dob" required></td>
				</tr>
				<tr>
					<td><b>Phone Number:</b></td>
					<td><input type="text" name="tel_number" required></td>
				</tr>
				<tr>
					<td><b>Email Address:</b></td>
					<td><input type="email" name="email" required></td>
				</tr>
				<tr>
					<td><b>Gender:</b></td>
					<td>
						<select name="gender" required>
							<option value="">Select Gender</option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</td>
				</tr>
				<tr>
					<td><b>Address:</b></td>
					<td><textarea rows="5" cols="50" name="address"  required></textarea></td>
				</tr>
				<tr>
					<td><b>Role:</b></td>
					<td>
						<select name="role_id" required>
							<option value="">Please Select a Role</option>
							<?php
							$sql = "SELECT * FROM tbl_role";
							$res = mysqli_query($conn, $sql);
							$count = mysqli_num_rows($res);
							if ($count > 0) {
								while ($row = mysqli_fetch_assoc($res)) {
									$role_id = $row['role_id'];
									$role_name = $row['role_name'];
									echo "<option value='$role_id'>$role_name</option>";
								}
							} else {
								echo "<option value='0'>No Role Found</option>";
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="submit" id="submit_btn" value="Add User" class="savebtn">
						<input type="reset" name="reset" value="Reset" class="cancelbtn">
					</td>
				</tr>
			</table>
		</form>
	</div>
	<!------------------------------ User Input Form ends ------------------------------>
</main>
</body>
</html>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 

<script>
	$(document).ready(function() {
		$('#addUserForm').submit(function(e) {
			e.preventDefault(); 
			var form = $(this);
			var formData = form.serialize(); 

			$.ajax({
				type: 'POST',
				url: '../controller/add_user_controller.php',
				data: formData,
				dataType: 'json',
				success: function(response) {
					if (response.error) {
						alert(response.error); // Display error message
					} else {
						alert(response.message); // Display success message
						if (!response.error) {
							// Clear each form field individually
							form.find('input[type=text], input[type=email], textarea').val('');
							form.find('select').prop('selectedIndex', 0);
						}
					}
				},
				error: function() {
					alert('An error occurred while processing the request.');
				}
			});
		});
	});
</script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
  $(document).ready(function() {
    $("#datepicker").datepicker({
      dateFormat: "yy-mm-dd",
      maxDate: "-18y", // Allow users to select a date 18 years ago or older
      changeMonth: true,
      changeYear: true
    });
  });
</script>