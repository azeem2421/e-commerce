<!--------------------------Start Navigation-------------------------->
<?php include "index.php"; ?>
        <style>
      <?php include "css/add_stock.css"; ?>
        </style>

      


    
  <!--------------------------End Navigation-------------------------->
  <main>
  <h1 align="center">Update Stock Quantity</h1>
  	<form method="post">
  		<select name="product_title" required class="js-select2">
  		<option value="">--Select a product--</option>
  <?php
  		// Get all products from the database
 		 $sql = "SELECT product_id, product_title FROM tbl_products";
  			$result = mysqli_query($conn, $sql);
  				if (mysqli_num_rows($result) > 0) 
			{
     		 // Output each product as an option in the select dropdown
     	 		while ($row = mysqli_fetch_assoc($result)) 
		 		{
          	echo '<option value="' . $row["product_id"] . '">' . $row["product_title"] . '</option>';
      			}
 		 	}
  ?>
	</select>

			<label for="quantity">Quantity to Add:</label>
			<input type="number" name="quantity" required><br>
			<input type="submit" name="submit" value="Update">
  	</form>
  		<?php
   			 // Check if form was submitted
    			if (isset($_POST['submit'])) {
					// Get input values
					$product_id = $_POST['product_title'];
					$quantity_to_add = $_POST['quantity'];

       			// Get the current stock quantity
						$sql = "SELECT product_quantity FROM tbl_products WHERE product_id = '$product_id'";
						$result = mysqli_query($conn, $sql);
						if (mysqli_num_rows($result) > 0) {
							$row = mysqli_fetch_assoc($result);
							$current_quantity = $row["product_quantity"];

				// Add the quantity and update the database
				$new_quantity = $current_quantity + $quantity_to_add;
				$sql = "UPDATE tbl_products SET product_quantity = '$new_quantity' WHERE product_id = '$product_id'";

						if (mysqli_query($conn, $sql)) {
							echo '<script>alert("Stock quantity updated successfully");</script>';
						} else {
						echo '<p class="error">Error updating stock quantity: ' . mysqli_error($conn) . '</p>';
						}
					} else {
						echo '<p class="error">Product not found</p>';
					}

				// Close connection
				mysqli_close($conn);
				}

  		?>
		</main>
	</body>
</html>
		<script>
		$(document).ready(function() {
			$('.js-select2').select2({
			placeholder: "--Select a product--",
			allowClear: true,
			});
		});
		</script>

    
