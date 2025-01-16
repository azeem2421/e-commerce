<?php	
	include('../controller/login_check.php');
	include('../model/connection.php');
	
?>

<?php
// Check if the form is submitted
if (isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['new_status'];
    $adminuser_id = $_SESSION['adminuser_id'];
    $datetime = date('Y-m-d H:i:s');
    
    // Retrieve the order status ID based on the new status
    $sql1 = "SELECT orderstatus_id FROM tbl_orderstatus WHERE orderstatus_name = '$new_status'";
    $res1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($res1);
    $orderstatus_id = $row1['orderstatus_id'];

    // Update the order status in the database        
    $sql2 = "INSERT INTO tbl_ordertracking (ordertracking_order_id, ordertracking_orderstatus_id, ordertracking_datetime, ordertracking_user_id)
            VALUES ('$order_id', '$orderstatus_id', '$datetime', '$adminuser_id')";
    $res2 = mysqli_query($conn, $sql2);

    if ($res2) {
        // Update the order status in the tbl_order table
        $sql3 = "UPDATE tbl_order SET order_status = '$new_status' WHERE order_id = $order_id";
        $res3 = mysqli_query($conn, $sql3);

        if ($res3) {
            echo '<script>alert("Order Status Updated Successfully");</script>';
            echo '<script>window.location.href = "../view/orders.php";</script>';
        } else {
            echo '<script>alert("Failed to Update Order Status");</script>';
        }
    } else {
        echo '<script>alert("Failed to Update Order Status");</script>';
    }
}
?>
