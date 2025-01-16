<?php

// Initialize an array to store total sales for each month
$totalSalesByMonth = array_fill(1, 12, 0);

// Retrieve total sales by month from the database for orders with status 'Delivered'
$sql = "SELECT MONTH(order_datetime) as month, SUM(order_total) as total
        FROM tbl_order
        WHERE YEAR(order_datetime) = YEAR(CURDATE())
        AND order_status = 'Delivered'
        GROUP BY MONTH(order_datetime)";

$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $month = (int) $row['month'];
    $totalSales = (float) $row['total'];
    $totalSalesByMonth[$month] = $totalSales;
}

// Data for the chart
$months = array(
    'January', 'February', 'March', 'April', 'May', 'June',
    'July', 'August', 'September', 'October', 'November', 'December'
);
$totalSalesData = array_values($totalSalesByMonth);

// Convert the data to JSON format to be used in JavaScript
$monthsJSON = json_encode($months);
$totalSalesDataJSON = json_encode($totalSalesData);

?>
