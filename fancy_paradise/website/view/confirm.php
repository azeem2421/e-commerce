<?php
include ('../../adminpanel/model/connection.php');

session_start();

// Retrieve the session variables
$s_id = $_SESSION['s_id'];
$title = $_SESSION['title'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$email = $_SESSION['email'];
$telephone_no = $_SESSION['telephone_no'];
$address = $_SESSION['address'];
$city_name = $_SESSION['city_id'];
$total = $_SESSION['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Success</title>
</head>
<body>
    <h3>Your Payment was successful</h3>

    <p><b>Name:</b> <?php echo $title;?> <?php echo $first_name;?> <?php echo $last_name;?> </p>
    <p><b>Email:</b> <?php echo $email;?> </p>
    <p><b>Telephone Number:</b> <?php echo $telephone_no;?> </p>
    <p><b>Address:</b> <?php echo $address;?>, <?php echo $city_name;?>.</p>  

    <p><b>Total:</b> <?php echo $total;?></p>
</body>
</html>
