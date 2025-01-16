<?php
    include '../model/connection.php';
    require_once('../../fpdf/fpdf.php');

    if (isset($_POST['month'])) {
        $selectedMonth = $_POST['month'];

        
      

        //  query to fetch the product details and total sales for the selected month
        $sql = "SELECT p.product_title, od.order_quantity, od.order_quantity * p.product_price AS total_sales
                FROM tbl_orderdetails od
                INNER JOIN tbl_order o ON od.order_id = o.order_id
                INNER JOIN tbl_products p ON od.product_id = p.product_id
                WHERE o.order_status = 'Delivered'
                AND MONTHNAME(o.order_datetime) = '$selectedMonth'";

        $res = mysqli_query($conn, $sql);

        if ($res) {
            
            $pdf = new FPDF();
            $pdf->AddPage();

            // Set font properties
            $pdf->SetFont('Arial', 'B', 14);

            // Add the report title
            $pdf->Cell(0, 10, 'Monthly Sales Report', 0, 1, 'C');

            // Set font properties for the table
            $pdf->SetFont('Arial', 'B', 12);

            // table header
            $pdf->Cell(60, 10, 'Product Title', 1, 0, 'C');
            $pdf->Cell(40, 10, 'Quantity Sold', 1, 0, 'C');
            $pdf->Cell(40, 10, 'Total Sales', 1, 1, 'C');

            // Set font properties for table content
            $pdf->SetFont('Arial', '', 12);

           
            while ($row = mysqli_fetch_assoc($res)) {
                $productTitle = $row['product_title'];
                $quantitySold = $row['order_quantity'];
                $totalSales = $row['total_sales'];

                $pdf->Cell(60, 10, $productTitle, 1, 0, 'C');
                $pdf->Cell(40, 10, $quantitySold, 1, 0, 'C');
                $pdf->Cell(40, 10, $totalSales, 1, 1, 'C');
            }

            // Fetch the total sales 
            $sqlTotalSales = "SELECT SUM(order_total) AS totalsales
                              FROM tbl_order
                              WHERE order_status = 'Delivered'
                              AND MONTHNAME(order_datetime) = '$selectedMonth'";
            $resTotalSales = mysqli_query($conn, $sqlTotalSales);
            $rowTotalSales = mysqli_fetch_assoc($resTotalSales);
            $totalSales = $rowTotalSales['totalsales'];

            // Add the total sales to the PDF
            $pdf->Cell(0, 10, 'Total Sales: ' . $totalSales, 0, 1, 'R');

            
            $pdf->Output('monthly_sales_report.pdf', 'I');
        } else {
            echo "Error retrieving product sales.";
        }
    }

?>
