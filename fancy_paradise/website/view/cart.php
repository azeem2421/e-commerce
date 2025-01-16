<?php
ob_start(); // Start output buffering
?>

<!-- Header Section Starts Here -->
<?php include('header.php') ?>

<style>
    <?php
    include('css/style.css');
    include('css/header.css');
    ?>
</style>

<?php
$pagelink = $_SERVER['REQUEST_URI'];

error_reporting(E_ERROR | E_WARNING | E_PARSE); // Error Handling

session_start();

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

$isCartEmpty = false; 


if (mysqli_num_rows($res) === 0) 
{
    $isCartEmpty = true;
}
?>

<!-- Cart Section Starts Here -->
<section class="cart">
    <div class="container">
        <h2 class="text-center">Cart</h2>

        <!-- Cart Items -->
        <div class="cartdisplay">
            <div class="cart-items">
                <?php
                $sql = "SELECT * FROM tbl_cart WHERE session_id = '$s_id'";
                $res = mysqli_query($conn, $sql);

                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $cart_id = $row['cart_id'];
                        $product_id = $row['product_id'];
                        $cart_qty = $row['cart_qty'];
                        $cart_product_price = $row['cart_product_price'];

                        // Retrieve the product details 
                        $product_sql = "SELECT * FROM tbl_products WHERE product_id = '$product_id'";
                        $product_res = mysqli_query($conn, $product_sql);

                        if (mysqli_num_rows($product_res) > 0) {
                            $product_row = mysqli_fetch_assoc($product_res);
                            $product_title = $product_row['product_title'];
                            $product_imgname = $product_row['product_imgname'];
                        }
                        ?>
                        <div class="cart-item">
                            <div class="item-image">
                                <img src="<?php echo SITEURL; ?>adminpanel/view/assets/Product_images/<?php echo $product_imgname; ?>" alt="<?php echo $product_title; ?>" class="img-responsive img-curve">
                            </div>
                            <div class="item-details">
                                <h4><?php echo $product_title; ?></h4>
                                <p>Price: <?php echo number_format($cart_product_price, 2) ?></p>
                                <div class="quantity">
                                    <form method="post" action="../controller/update_quantity.php">
                                        <input type="hidden" name="cart_id" value="<?php echo $cart_id; ?>">
                                        <button type="submit" class="btn-quantity" name="quantity" value="<?php echo $cart_qty - 1; ?>">-</button>
                                    </form>
                                    <input type="number" class="input-quantity"  min="1" value="<?php echo $cart_qty; ?>">
                                    <form method="post" action="../controller/update_quantity.php">
                                        <input type="hidden" name="cart_id" value="<?php echo $cart_id; ?>">
                                        <button type="submit" class="btn-quantity" name="quantity" value="<?php echo $cart_qty + 1; ?>">+</button>
                                    </form>
                                </div>
                                <form method="post" action="../controller/remove_item.php">
                                    <input type="hidden" name="cart_id" value="<?php echo $cart_id; ?>">
                                    <button type="submit" class="btn-danger">Remove</button>
                                </form>                                
                            </div>
                            
                        </div>
                        <hr>
                <?php
                    }
                } else {
                    echo "<p>No products found in the cart.</p>";
                }
                ?>
                                <form method="post" action="../controller/clear_cart.php">
                                <?php
                                // Check if the cart is empty
                                $sql = "SELECT * FROM tbl_cart WHERE session_id = '$s_id'";
                                $res = mysqli_query($conn, $sql);
                                $isCartEmpty = mysqli_num_rows($res) == 0;

                                if ($isCartEmpty) {
                                    
                                    echo '<button type="button" class="clear-cart-btn" disabled>Clear Cart</button>';
                                } else {
                                    
                                    echo '<button type="submit" class="clear-cart-btn" onclick="return confirm(\'Are you sure you want to clear the cart?\')" name="confirm_clear">Clear Cart</button>';
                                }
                                ?>
                                </form>
            </div>
                
            <h3>Cart Summary</h3>

            <div class="summary-details">
                <!-- Calculate total items and total price from the retrieved cart items -->
                <?php
                $totalItems = mysqli_num_rows($res);
                $totalPrice = 0;
                $subtotal = 0;
                $taxPercentage = 3;

                mysqli_data_seek($res, 0); 

                while ($row = mysqli_fetch_assoc($res)) 
                {
                    $cart_qty = $row['cart_qty'];
                    $cart_product_price = $row['cart_product_price'];
                    $subtotal += ($cart_qty * $cart_product_price);
                }

                $taxAmount = ($subtotal * $taxPercentage) / 100;
                $totalPrice = $subtotal + $taxAmount;

                
                $_SESSION['order_total'] = $totalPrice;

                $isCartEmpty = ($totalItems === 0); 
                ?>

                <p>Total Items: <?php echo $totalItems; ?></p>
                <p>Sub Total: <?php echo number_format($subtotal, 2) ?></p>
                <p>Tax (<?php echo $taxPercentage; ?>%): <?php echo number_format($taxAmount, 2) ?></p>
                <p style="border-bottom:black double 5px;border-top: black solid 2px;">Grand Total: Rs. <?php echo number_format($totalPrice, 2); ?></p>

                <br>
                <?php if ($isCartEmpty) { ?>
                    <p style="color: red; font-weight: bold;">Your cart is empty. Please add items to proceed to checkout.</p>

                <?php } else { ?>
                    <a href="proceed.php?s_id=<?php echo $s_id; ?>" class="checkoutbtn">
                        Proceed to Checkout
                    </a>
                <?php } ?>
            </div>


        </div>
    </div>
</section>

<!-- Footer Section Starts Here -->
<?php include('footer.php') ?>

<style>
    <?php
    include('css/footer.css');
    ?>
</style>
