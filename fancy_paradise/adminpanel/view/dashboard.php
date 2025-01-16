

	<!--------------------------Start Navigation-------------------------->
			<?php
				include "index.php";
				include "monthlysales.php";
				include "totalsellingchart.php";
			?>
			<style>
      		<?php include "css/dashboard.css"; ?>
        	</style>
		
	<!--------------------------End Navigation-------------------------->

	<main>
        <h1 class="sticky"><i class="fa fa-tachometer" aria-hidden="true"></i> DASHBOARD </h1>
			<div class="chartcontainer">

					<div class="topsellingchart">
						<canvas id="topSellingChart"></canvas>
						<script>
							const chartData = <?php echo $chartData; ?>;
							const ctx = document.getElementById('topSellingChart').getContext('2d');
							new Chart(ctx, chartData);
						</script>
					</div>

					<div class="saleschart">
						<canvas id="salesChart"></canvas>
							<script>
								// Chart configuration
								var salesData = {
									labels: <?php echo $monthsJSON; ?>,
									datasets: [{
										label: 'Monthly Sales',
										data: <?php echo $totalSalesDataJSON; ?>,
										backgroundColor: 'rgba(75, 192, 192, 0.5)',
										borderColor: 'rgba(75, 192, 192, 1)',
										borderWidth: 1
									}]
								};

								// Chart options
								var salesOptions = {
									scales: {
										y: {
											beginAtZero: true,
											ticks: {
												stepSize: 1000 // step size of the y-axis ticks 
											}
										}
									}
								};

								// Create the chart
								var salesChart = new Chart(document.getElementById('salesChart'), {
									type: 'bar',
									data: salesData,
									options: salesOptions
								});
							</script>
					</div>
				</div>
			<div class="countreports">
				<table class="pendingorders">
					<?php
						$sql="SELECT * FROM tbl_order WHERE order_status='Pending'";
						$res=mysqli_query($conn,$sql);
						$count=mysqli_num_rows($res);			
					?>

						<thead>
							<tr>
								<th>TOTAL PENDING ORDERS</th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td><?php echo $count; ?></td>
							</tr>
						</tbody>
				</table>
			

			
				<table class="totalusers">
					<?php
						$sql2="SELECT * FROM tbl_adminuser WHERE adminuser_id";
						$res2=mysqli_query($conn,$sql2);
						$count2=mysqli_num_rows($res2);			
					?>

						<thead>
							<tr>
								<th>TOTAL USERS</th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td><?php echo $count2; ?></td>
							</tr>
						</tbody>
				</table>


				<table class="totalproducts">
					<?php
						$sql3="SELECT * FROM tbl_products WHERE product_id";
						$res3=mysqli_query($conn,$sql3);
						$count3=mysqli_num_rows($res3);			
					?>

						<thead>
							<tr>
								<th>TOTAL PRODUCTS</th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td><?php echo $count3; ?></td>
							</tr>
						</tbody>
				</table>


				<table class="totalcategories">
					<?php
						$sql4="SELECT * FROM tbl_category WHERE category_id";
						$res4=mysqli_query($conn,$sql4);
						$count4=mysqli_num_rows($res4);			
					?>

						<thead>
							<tr>
								<th>TOTAL CATEGORIES</th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td><?php echo $count4; ?></td>
							</tr>
						</tbody>
				</table>
			</div>
    </main>
</body>
</html>