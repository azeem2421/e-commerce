
<!-- Header Section Starts Here -->
<?php include('header.php') ?>

<style>
    <?php
    include('css/style.css');
    include('css/header.css');
    ?>
</style>
<?php  
// Retrieve the session variables
$s_id = $_SESSION['s_id'];
$title = $_SESSION['title'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$email = $_SESSION['email'];
$telephone_no = $_SESSION['telephone_no'];
$address = $_SESSION['address'];
$city_id = $_SESSION['city_id'];
$totalPrice = $_SESSION['order_total'];


include ('../../adminpanel/controller/hashpayment.php');

$sql = "SELECT * FROM tbl_city WHERE city_id = '$city_id'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
$city_name = $row['city_name'];


?>

<!-- customer details Section Starts Here -->
<section class="container">    
    <h2 class="text-center">Proceed for Payment</h2>
    <div class="proceed_payment">
            
            <div class="customer_details">            
                <p><b>Name:</b> <?php echo $title;?> <?php echo $first_name;?> <?php echo $last_name;?> </p>
                <p><b>Email:</b> <?php echo $email;?> </p>
                <p><b>Telephone Number:</b> <?php echo $telephone_no;?> </p>
                <p><b>Address:</b> <?php echo $address;?>, <?php echo $row['city_name'];?>.</p>                
                
                
            </div>

            <div class="proceed_payment_details">
            <table>
                <tr>
                    <th>Product Title</th>
                    <th>&nbsp;</th>
                    <th>Quantity</th>
                </tr>

                <?php
                // Fetch items from the cart
                $sql2 = "SELECT * FROM tbl_cart c, tbl_products p
                    WHERE c.product_id = p.product_id AND c.session_id = '$s_id'";
                $res2 = mysqli_query($conn, $sql2);
                $subTotal = 0; // Variable to store the subtotal

                while ($row2 = mysqli_fetch_assoc($res2)) {
                    $product_title = $row2['product_title'];
                    $quantity = $row2['cart_qty'];
                    $price = $row2['cart_product_price'];                    
                    ?>

                    <tr>
                        <td><?php echo $product_title; ?></td>
                        <td>&nbsp;</td>
                        <td><?php echo $quantity; ?></td>
                    </tr>

                <?php } ?>

                <tr>
                    <td colspan="2">&nbsp;</td> 
                </tr>

                <?php
                // Calculate delivery cost and total
                $delivery_cost = $row['city_amount'];
                $total = $totalPrice + $delivery_cost;
                ?>
                <tr>
                    <td><label for="sub_total">Sub Total:</label></td>
                    <td>Rs.<?php echo $totalPrice; ?></td>
                </tr>

                <tr>
                    <td><label for="delivery_cost">Delivery Cost:</label></td>
                    <td>Rs.<?php echo $delivery_cost; ?></td>
                </tr>

                <tr style="border-top: solid 2px;border-bottom: double 10px;">
                    <td><label for="total"><b>Total:</b></label></td>
                    <td><b>Rs.<?php echo $total; ?></b></td>
                </tr>

            </table>
            <?php
            $_SESSION['city_amount'] = $delivery_cost; 
            $_SESSION['total'] = $total;                   
            ?>
            <button type="submit" id="payhere-payment">PayHere Pay</button>
            
            <a href="../controller/paymentcontroller.php" onclick="confirmOrder(event)"><button type="submit" id="pay_now">Cash on delivery</button></a>

            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

            <script>
                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    alert("Payment Successfull. Your Order ID:" + orderId);
                    // Note: validate the payment and show success or failure page to the customer
                    window.location.replace("http://localhost/fancy_paradise/website/view/confirm.php");
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:"  + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "<?php echo $merchant_id; ?>",
                    "return_url": "http://localhost/fancy_paradise/website/view/payment.php",
                    "cancel_url": undefined,
                    "notify_url": "http://localhost/fancy_paradise/website/view/payment.php",
                    "order_id": "<?php echo $order_id; ?>",
                    "items": "Door bell wireless",
                    "amount": "<?php echo $total; ?>",
                    "currency": "<?php echo $currency; ?>",
                    "hash": "<?php echo $hash; ?>",
                    "first_name": "<?php echo $first_name; ?>",
                    "last_name": "<?php echo $last_name; ?>",
                    "email": "<?php echo $email; ?>",
                    "phone": "<?php echo $telephone_no; ?>",
                    "address": "<?php echo $address; ?>",
                    "city": "<?php echo $city_name;  ?>",
                    "country": "Sri Lanka",
                    "delivery_address": "No. 46, Galle road, Kalutara South",
                    "delivery_city": "Kalutara",
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup when "PayHere Pay" is clicked
                document.getElementById('payhere-payment').onclick = function (e) {
                    payhere.startPayment(payment);
                };

                
            </script>


                        <div class="clearfix"></div>
            </div>

    </div>
</section>

<script>
		function confirmOrder(event) {
			var result = confirm('You are about to successfully place your order. Are You Confirm?');
			if (result === false) {
				event.preventDefault();
			}
		}
	</script>

<!-- Footer Section Starts Here -->
<?php include('footer.php') ?>

<style>
    <?php
    include('css/footer.css');
    ?>
</style>
