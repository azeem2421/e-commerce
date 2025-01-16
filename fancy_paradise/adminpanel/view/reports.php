

	<!--------------------------Start Navigation-------------------------->
			<?php
				include "index.php";
				include "loginandtrackingchart.php";
			?>
			<style>
      		<?php include "css/reports.css"; ?>
        	</style>

		
	<!--------------------------End Navigation-------------------------->

	<main>
    <h1 class="sticky"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> REPORTS</h1>
	
	<div class="chartcontainer">
		<h2>Login Chart for Last 28 Days</h2>
      	<canvas id="chartcontainer"></canvas>
	</div>

	<div class="salesreportproduct">
    <h2>Monthly Sales Report</h2>
    <form method="POST" action="">
        <label for="month">Select Month:</label>
        <select name="month" id="month">
            <option value="January">January</option>
            <option value="February">February</option>
            <option value="March">March</option>
            <option value="April">April</option>
            <option value="May">May</option>
            <option value="June">June</option>
            <option value="July">July</option>
            <option value="August">August</option>
            <option value="September">September</option>
            <option value="October">October</option>
            <option value="November">November</option>
            <option value="December">December</option>
        </select>
        <button type="submit">Get Total Sales</button>
    </form>

    <?php
    if (isset($_POST['month'])) {

        $selectedMonth = $_POST['month'];

        // Modify the SQL query to fetch the product details and total sales for the selected month
        $sql = "SELECT p.product_title, od.order_quantity, od.order_quantity * p.product_price AS total_sales
                FROM tbl_orderdetails od
                INNER JOIN tbl_order o ON od.order_id = o.order_id
                INNER JOIN tbl_products p ON od.product_id = p.product_id
                WHERE o.order_status = 'Delivered'
                AND MONTHNAME(o.order_datetime) = '$selectedMonth'";

        $res = mysqli_query($conn, $sql);

        if ($res && mysqli_num_rows($res) > 0) {
            // Display the table header
            echo '<table style="border-collapse: separate; border-spacing: 40px; align:center;">
        <tr>
            <th>Product Title</th>
            <th>Quantity Sold</th>
            <th>Total Sales</th>
        </tr>';

		// Display the product details and total sales in the table rows
		while ($row = mysqli_fetch_assoc($res)) {
			$productTitle = $row['product_title'];
			$quantitySold = $row['order_quantity'];
			$totalSales = $row['total_sales'];

			echo "<tr>
					<td>$productTitle</td>
					<td>$quantitySold</td>
					<td>$totalSales</td>
				</tr>";
		}

		// Close the table
		echo "</table>";
		


            // Fetch the total sales for the selected month
            $sqlTotalSales = "SELECT SUM(order_total) AS totalsales
                              FROM tbl_order
                              WHERE order_status = 'Delivered'
                              AND MONTHNAME(order_datetime) = '$selectedMonth'";
            $resTotalSales = mysqli_query($conn, $sqlTotalSales);
            $rowTotalSales = mysqli_fetch_assoc($resTotalSales);
            $totalSales = $rowTotalSales['totalsales'];

            // Display the total sales for the selected month
            echo "<p>Total Sales for $selectedMonth: $totalSales</p>";
			echo '<div><button type="submit" formaction="../controller/salesreportpdf.php">Generate PDF</button></div>';
        } else {
            // No records found
            echo "<p>No sales data available for $selectedMonth.</p>";
        }

        
    }
    ?>
		
</div>


</main>

</body>
</html>


