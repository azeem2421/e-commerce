<?php
include ('../../adminpanel/model/connection.php');

$pagelink = $_SERVER['REQUEST_URI'];
error_reporting(E_ERROR | E_WARNING | E_PARSE); // Error Handling

session_start();

if (!isset($_SESSION['s_id'])) {
    // To get IP address
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $_SESSION['s_id'] = time() . "_" . $ip;
}

require_once('../../fpdf/fpdf.php');

$s_id = $_SESSION['s_id'];

// Create a new PDF instance
$pdf = new FPDF();
$pdf->AddPage();

// Heading
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(0, 10, 'Order Details', 0, 1, 'C');

// Company details
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(0, 10, 'Fancy Paradise', 0, 1, 'L');
$pdf->Cell(0, 10, 'No.181,', 0, 1, 'L');
$pdf->Cell(0, 10, 'Galle Road, Dehiwala.', 0, 1, 'L');
$pdf->Cell(0, 10, date('d F Y'), 0, 1, 'L');

// Customer details
$sql = "SELECT * FROM tbl_order o, tbl_customer c, tbl_city ct WHERE o.customer_id=c.customer_id AND o.city_id=ct.city_id AND o.session_id='$s_id'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);

$order_id = $row['order_id'];
$order_id_full = str_pad($order_id, 6, '0', STR_PAD_LEFT);
$customer_name = $row['title'] . " " . $row['first_name'] . " " . $row['last_name'];
$telephone_no = $row['telephone_no'];
$email = $row['email'];
$address = $row['address'];
$city_name = $row['city_name'];

$sql2 = "SELECT od.order_quantity, od.order_prd_price, pd.product_title
        FROM tbl_orderdetails od
        INNER JOIN tbl_products pd ON od.product_id = pd.product_id
        WHERE od.order_id = '$order_id'";

// Order details
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(0, 10, 'Order ID: ' . $order_id_full, 0, 1, 'L');
$pdf->SetFont('Arial', '', 13);
$pdf->Cell(0, 10, 'Customer: ' . $customer_name, 0, 1, 'L');
$pdf->Cell(0, 10, 'Phone Number: ' . $telephone_no, 0, 1, 'L');
$pdf->Cell(0, 10, 'Email Address: ' . $email, 0, 1, 'L');
$pdf->Cell(0, 10, 'Address: ' . $address . ' ' . $city_name, 0, 1, 'L');

// Order Details Table Headings
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(20, 10, 'No.', 1, 0, 'C');
$pdf->Cell(45, 10, 'Product Title', 1, 0, 'C');
$pdf->Cell(45, 10, 'Product Price', 1, 0, 'C');
$pdf->Cell(25, 10, 'Quantity', 1, 0, 'C');
$pdf->Cell(30, 10, 'Total', 1, 1, 'C');

// Order Details Table contents
$res2 = mysqli_query($conn, $sql2);
$sno = 1;
$product_totals = array(); // Array to store product totals

while ($row2 = mysqli_fetch_assoc($res2)) {
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(20, 10, $sno++, 1, 0, 'C');
    $pdf->Cell(45, 10, $row2['product_title'], 1, 0, 'C');
    $pdf->Cell(45, 10, $order_product_price = $row2['order_prd_price'], 1, 0, 'C');
    $pdf->Cell(25, 10, $order_quantity = $row2['order_quantity'], 1, 0, 'C');
    $product_total = $order_product_price * $order_quantity;
    $product_totals[] = $product_total; // 
    $pdf->Cell(30, 10, $product_total, 1, 1, 'C');
}

$pdf->SetFont('Arial', '', 13);
$pdf->Cell(0, 10, 'Thank You For Ordering ', 0, 1, 'C');

// Save the PDF file
$pdf->Output('order_summary.pdf', 'D');
?>
