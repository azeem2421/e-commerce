<?php

include ('../../adminpanel/model/connection.php');

session_start();

if (isset($_POST['cart_id'])) {
    $cart_id = $_POST['cart_id'];

    // Perform the necessary database operations to remove the item from the cart
    $sql = "DELETE FROM tbl_cart WHERE cart_id = '$cart_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Item removed successfully
        header("Location: ../view/cart.php");
        exit();
    } else {
        // Error occurred while removing item
        echo "Error: " . mysqli_error($conn);
    }
}
?>
