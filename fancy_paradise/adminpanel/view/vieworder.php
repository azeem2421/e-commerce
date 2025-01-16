<?php
include('../model/connection.php');
include('../controller/login_check.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
    <link rel="stylesheet" href="../view/css/vieworder.css">
</head>
<body>
    <h1 align="center">Order Details</h1>

    <?php
    if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];

        // SQL query to retrieve order details with a subquery for ordertracking_order_id
        $sql = "SELECT * FROM tbl_order o, tbl_customer c, tbl_ordertracking ot, tbl_city ct, tbl_orderdetails od, tbl_products p, tbl_orderstatus os
                WHERE o.customer_id = c.customer_id
                AND o.city_id = ct.city_id
                AND o.order_id = od.order_id
                AND od.product_id = p.product_id
                AND os.orderstatus_id = ot.ordertracking_orderstatus_id
                AND o.order_id = $order_id
                AND ot.ordertracking_order_id = (SELECT ordertracking_order_id FROM tbl_ordertracking WHERE ordertracking_order_id = $order_id LIMIT 1)";

        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);

            $order_id = $row['order_id'];
            $customer_name = $row['first_name'] . ' ' . $row['last_name'];
            $order_pay_type = $row['order_pay_type'];
            $order_total = $row['order_total'];
            $order_datetime = $row['order_datetime'];
            $orderstatus_id = $row['orderstatus_id'];
            $order_status = $row['order_status'];
            $delivery_address = $row['delivery_address'];
            $city_name = $row['city_name'];

            ?>
            <p>Customer Name: <?php echo $customer_name; ?></p>
            <p>Payment Type: <?php echo $order_pay_type; ?></p>
            <p>Total Amount: <?php echo $order_total; ?></p>
            <p>Order Date: <?php echo $order_datetime; ?></p>
            <p>Order Status: <?php echo $order_status; ?></p>
            <p>Delivery Address: <?php echo $delivery_address; ?></p>
            <p>City: <?php echo $city_name; ?></p>

            <!-- Display the order items -->
            <h2 align="center">Ordered Items</h2>
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Title</th>
                        <th>Product Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    mysqli_data_seek($res, 0); // Reset the result pointer
                    while ($row = mysqli_fetch_assoc($res)) {
                        $product_id = $row['product_id'];
                        $product_title = $row['product_title'];
                        $product_price = $row['product_price'];
                        $order_quantity = $row['order_quantity'];
                        $subtotal = $product_price * $order_quantity;

                        // Add a condition to show products only for relevant order status
                        if ($row['orderstatus_id'] == $orderstatus_id) {
                            ?>
                            <tr>
                                <td><?php echo $product_id; ?></td>
                                <td><?php echo $product_title; ?></td>
                                <td><?php echo $product_price; ?></td>
                                <td><?php echo $order_quantity; ?></td>
                                <td><?php echo $subtotal; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>

            <?php if ($order_status !== 'Rejected') { ?>
                <!-- Form to update the order status -->
                <h2 align="center">Update Order Status</h2> <br>
                <form method="POST" action="../controller/update_orderstatus.php" align="center">               
                    <input type="hidden" name="order_id" value="<?php echo $order_id;?>">
                    <input type="radio" name="new_status" value="Processing"> Accept &nbsp; &nbsp;
                    <input type="radio" name="new_status" value="Rejected"> Reject &nbsp; &nbsp;
                    <input type="radio" name="new_status" value="Ready">Ready &nbsp; &nbsp;
                    <input type="radio" name="new_status" value="Dispatched">Dispatched &nbsp; &nbsp;
                    <input type="radio" name="new_status" value="Delivered">Delivered<br><br>                   
                    <input type="submit" name="update_status" value="Update Status" class="updatestatus">
                </form>
            <?php } ?>
        <?php } else {
            echo "No order found.";
        }
    }
    ?>
</body>
</html>
