<!-- Header Section Starts Here -->
<?php include('header.php'); ?>
<!-- Header Section Ends Here -->

<style>
    <?php
    include('css/style.css');
    include('css/header.css');
    include('css/footer.css');
    ?>
</style>

<!-- View Orders Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Orders</h2>

        <?php
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];

            $sql = "SELECT customer_id FROM tbl_cuslogin WHERE user_id = '$user_id'";
            $res = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($res);
            $customer_id = $row['customer_id'];

            // Retrieve the customer's orders from the tbl_order table
            $sql2 = "SELECT * FROM tbl_order WHERE customer_id = $customer_id";
            $res2 = mysqli_query($conn, $sql2);

            // Check if any orders found
            if (mysqli_num_rows($res2) > 0) {
                ?>
                <table class="customerorders">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>Order Total</th>
                            <th>Order Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($res2)) {
                            $order_id = $row['order_id'];
                            $order_date = $row['order_datetime'];
                            $order_total = $row['order_total'];
                            $order_status = $row['order_status'];
                            ?>
                            <tr>
                                <td><?php echo $order_id; ?></td>
                                <td><?php echo $order_date; ?></td>
                                <td><?php echo $order_total; ?></td>
                                <td><?php echo $order_status; ?></td>
                                <td><a href="order_details.php?order_id=<?php echo $order_id; ?>">View Details</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php
            } else {
               
                echo '<p>No orders found.</p>';
            }
        } 
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- View Orders Section Ends Here -->

<!-- Footer Section Starts Here -->
<?php include('footer.php'); ?>
<!-- Footer Section Ends Here -->
