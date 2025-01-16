<?php
$merchant_id = "1223315";
$order_id = $s_id; // Use the session ID as the order ID or assign a unique ID
$amount = $totalPrice; // Use the cart total as the amount
$currency = "LKR";
$merchant_secret = "MjMwNDgyMDYwOTk2NTU2NjAwMjI1OTg5NjM5NTM2OTgxMDQ2MDA="; // Replace with your actual merchant secret

$hash = strtoupper(
    md5(
        $merchant_id . 
        $order_id . 
        number_format((float) $amount, 2, '.', '') . 
        $currency .  
        strtoupper(md5($merchant_secret)) 
    ) 
);
?>
