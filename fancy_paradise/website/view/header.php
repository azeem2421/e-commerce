<?php
session_start(); // Start the session

include('../../adminpanel/model/connection.php');

$pagelink = $_SERVER['REQUEST_URI'];

error_reporting(E_ERROR | E_WARNING | E_PARSE); // Error Handling

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

$s_id = $_SESSION['s_id'];
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

$sql = "SELECT * FROM tbl_cart WHERE session_id = '$s_id'";
$res = mysqli_query($conn, $sql);
$count = mysqli_num_rows($res);

if ($count == 0) {
    $count = 0; // Set count to zero if there are no items in the cart
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Fancy Paradise Website</title>
    <link rel="icon" href="assets/logo.jpg" type="image/x-icon"> 
   
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <!-- Navbar Section Starts Here -->
    <header>
        <ul>
            <li><img src="assets/logo.jpg" alt="logo"></li>
            <li><a href="<?php echo SITEURL; ?>website/view/index.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'class="active"' : ''; ?>>Home</a></li>
            <li><a href="<?php echo SITEURL; ?>website/view/categories.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'categories.php') ? 'class="active"' : ''; ?>>Categories</a></li>
            <li><a href="<?php echo SITEURL; ?>website/view/products.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'products.php') ? 'class="active"' : ''; ?>>Products</a></li>
            <li><a href="<?php echo SITEURL; ?>website/view/contact_us.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'contact_us.php') ? 'class="active"' : ''; ?>>Contact Us</a></li>
            <li>
                <a href="<?php echo SITEURL; ?>website/view/cart.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'cart.php') ? 'class="active"' : ''; ?>>
                    <span class="material-icons-outlined">shopping_cart</span>
                    <?php if ($count > 0) : ?>
                        <span class="cart-count"><?php echo $count; ?></span>
                    <?php else : ?>
                        <span class="cart-count">0</span>
                    <?php endif; ?>
                </a>
            </li>
            <li id="login">
                <?php
                if(isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
                    
                    // Retrieve the customer email address based on the user_id from the tbl_cuslogin table
                    $sql = "SELECT email FROM tbl_cuslogin WHERE user_id = '$user_id'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    if($row) {
                        $email = $row['email'];
                        echo '<a href="' . SITEURL . 'website/view/customer.php?user_id=' . $user_id . '">View Profile</a>'; 
                        echo '<a href="' . SITEURL . 'website/view/customer.php?user_id=' . $user_id . '">' . $email . '</a>';                        
                        echo '<a href="' . SITEURL . 'website/view/logout.php" onclick="logoutAnimation()">Logout</a>';

                    } 
                } else {
                    echo '<a href="' . SITEURL . 'website/view/user_login.php">Login/Register</a>';
                }
                ?>
            </li>

        </ul>
    </header>
    
</body>
</html>
