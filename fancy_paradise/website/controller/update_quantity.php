<?php
include ('../../adminpanel/model/connection.php');

session_start();

if (isset($_POST['cart_id'])) {
    $cart_id = $_POST['cart_id'];
    $new_quantity = $_POST['quantity']; // Get the new quantity value
    
    // Check if the new quantity is greater than 1
    if ($new_quantity >= 1) {
        $sql = "UPDATE tbl_cart SET cart_qty = '$new_quantity' WHERE cart_id = '$cart_id'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Quantity updated successfully
            header("Location: ../view/cart.php");
            exit();
        } else {
            // Error occurred while updating quantity
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Set the quantity to 1 if it goes below 1
        $sql = "UPDATE tbl_cart SET cart_qty = 1 WHERE cart_id = '$cart_id'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Quantity set to 1 successfully
            header("Location: ../view/cart.php");
            exit();
        } else {
            // Error occurred while setting quantity to 1
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
