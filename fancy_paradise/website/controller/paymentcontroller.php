<?php
include ('../../adminpanel/model/connection.php');

session_start();

// Retrieve the form data from session variables
$title = $_SESSION['title'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$email = $_SESSION['email'];
$telephone_no = $_SESSION['telephone_no'];
$address = $_SESSION['address'];
$city_id = $_SESSION['city_id'];
$total = $_SESSION['total'];
$city_amount = $_SESSION['city_amount'];

// Check if the customer already exists with the given phone number or email address
$sql = "SELECT * FROM tbl_customer WHERE telephone_no = '$telephone_no' AND email = '$email'";
$res = mysqli_query($conn, $sql);

if (mysqli_num_rows($res) == 0) {
    // Insert values into the customer table
    $sql2 = "INSERT INTO tbl_customer (title, first_name, last_name, address, telephone_no, email, status, added_datetime)
              VALUES ('$title', '$first_name', '$last_name', '$address', '$telephone_no', '$email', 'Active', NOW())";

    mysqli_query($conn, $sql2);

    // Retrieve the generated customer_id
    $customer_id = mysqli_insert_id($conn);
} else {
    // Retrieve the existing customer_id
    $row = mysqli_fetch_assoc($res);
    $customer_id = $row['customer_id'];
}

// Retrieve the session ID
$s_id = $_SESSION['s_id'];

// Retrieve the session variables
$order_type = isset($_SESSION['order_type']) ? $_SESSION['order_type'] : '';
$order_pay_type = isset($_SESSION['order_pay_type']) ? $_SESSION['order_pay_type'] : '';

// Insert values into the tbl_order table
$sql3 = "INSERT INTO tbl_order (session_id, customer_id, order_type, order_pay_type, order_total, order_datetime, order_status, performed_by, delivery_address, city_id, city_payment)
         VALUES ('$s_id', '$customer_id', 'Online', 'Cash', '$total', NOW(), 'Pending', NULL, '$address', '$city_id', '$city_amount')";

mysqli_query($conn, $sql3);

// Retrieve the generated order_id
$order_id = mysqli_insert_id($conn);

// Retrieve cart items based on session ID
$sql4 = "SELECT * FROM tbl_cart WHERE session_id = '$s_id'";
$res2 = mysqli_query($conn, $sql4);

// Insert order details into the tbl_orderdetails table
while ($row2 = mysqli_fetch_assoc($res2)) {
    $product_id = $row2['product_id'];
    $order_quantity = $row2['cart_qty'];  
    $product_price = $row2['cart_product_price'];

    $sql5 = "INSERT INTO tbl_orderdetails (order_id, product_id, order_quantity, order_prd_price)
             VALUES ('$order_id', '$product_id', '$order_quantity', '$product_price')";

    mysqli_query($conn, $sql5);
}

// Insert payment information into tbl_payment table
$reference_no = $order_id . $customer_id . date('Ymd');
$payment_type = 'Cash';
$payment_total = $total;

$sql8 = "INSERT INTO tbl_payment (order_id, reference_no, payment_type, payment_total)
         VALUES ('$order_id', '$reference_no', '$payment_type', '$payment_total')";

mysqli_query($conn, $sql8);

// Set the payment total in the session for further use if needed
$_SESSION['payment_total'] = $payment_total;

// Insert order tracking information into tbl_ordertracking table
$datetime = date('Y-m-d H:i:s');

// Prepare the SQL statement
$sql9 = "INSERT INTO tbl_ordertracking (ordertracking_order_id, ordertracking_orderstatus_id, ordertracking_datetime)
        VALUES ('$order_id', '1', '$datetime')";

mysqli_query($conn, $sql9);

// Store the order_id in the session variable
$_SESSION['order_id'] = $order_id;
$_SESSION['first_name']=$first_name;
$_SESSION['last_name']=$last_name ;
$_SESSION['email']=$email;

// Redirect to the success page or perform any other necessary actions
header("Location: ../view/sendmail.php");
?>
