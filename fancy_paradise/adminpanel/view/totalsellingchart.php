<?php

// Retrieve product data
$sql = "SELECT p.product_title, SUM(od.order_quantity) as total_sales
        FROM tbl_products p
        INNER JOIN tbl_orderdetails od ON p.product_id = od.product_id
        GROUP BY p.product_id
        ORDER BY total_sales DESC
        LIMIT 5";

$result = mysqli_query($conn, $sql);

// Store product titles and sales quantities
$productTitles = array();
$totalSales = array();

while ($row = mysqli_fetch_assoc($result)) {
    $productTitles[] = $row['product_title'];
    $totalSales[] = (int) $row['total_sales'];
}

// Chart configuration and data
$chartConfig = [
    'type' => 'pie',
    'data' => [
        'labels' => $productTitles,
        'datasets' => [
            [
                'label' => 'Top 5 Purchased Products',
                'backgroundColor' => ['rgba(75, 192, 192, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 99, 132, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(153, 102, 255, 0.2)'],
                'borderColor' => ['rgba(75, 192, 192, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)', 'rgba(255, 206, 86, 1)', 'rgba(153, 102, 255, 1)'],
                'borderWidth' => 1,
                'data' => $totalSales,
            ],
        ],
    ],
    'options' => [
        'scales' => [
            'y' => [
                'beginAtZero' => true,
            ],
        ],
    ],
];

// Convert the chart configuration to JSON for use in JavaScript
$chartData = json_encode($chartConfig);

?>
