<?php
// Start the session and include your database connection file
session_start();
include('../../adminpanel/model/connection.php');

// Get the session ID
$s_id = $_SESSION['s_id'];

// Clear the cart for the current session ID
$sql = "DELETE FROM tbl_cart WHERE session_id = '$s_id'";
mysqli_query($conn, $sql);

// Redirect back to the cart page or any other desired page
header("Location: ../view/cart.php");
exit();
?>
