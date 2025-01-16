<?php
include('../../adminpanel/model/connection.php');

$session_id = $_REQUEST['s_id'];
$product_id = $_REQUEST['product_id'];
$product_price = $_REQUEST['product_price'];
$product_quantity = $_REQUEST['product_quantity'];
$pagelink = $_REQUEST['pagelink'];

// Check if the product already exists in the cart
$sql3 = "SELECT * FROM tbl_cart WHERE session_id = '$session_id' AND product_id = '$product_id'";
$res3 = mysqli_query($conn, $sql3);

if (mysqli_num_rows($res3) > 0) {
    // Product already exists, update the quantity
    $row = mysqli_fetch_assoc($res3);
    $cart_id = $row['cart_id'];
    $existing_quantity = $row['cart_qty'];
    $new_quantity = $existing_quantity + $product_quantity;

    $sql4 = "UPDATE tbl_cart SET cart_qty = '$new_quantity' WHERE cart_id = '$cart_id'";
    $res4 = mysqli_query($conn, $sql4);

    if ($res4) {
        echo '<script>alert("Product quantity updated successfully");</script>';
        echo '<script>window.location.href = "'.$pagelink.'";</script>';
    } else {
        echo '<script>alert("Failed to update product quantity. Please try again");</script>';
        echo '<script>window.location.href = "'.$pagelink.'";</script>';
    }
    
    exit();
}

// Add the product to the cart
$sql5 = "INSERT INTO tbl_cart (session_id, product_id, cart_qty, cart_product_price) VALUES ('$session_id', '$product_id', '$product_quantity', '$product_price')";
$res5 = mysqli_query($conn, $sql5);

if ($res5) {
    echo '<script>alert("Product added to cart successfully");</script>';
    echo '<script>window.location.href = "'.$pagelink.'";</script>';
    exit();
} else {
    echo '<script>alert("Failed to add product to cart. Please try again");</script>';
    echo '<script>window.location.href = "'.$pagelink.'";</script>';
    exit();
}
?>
