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
        <h2 class="text-center">Order Details</h2>

        <?php
        // Check if order ID is set in the query string
        if (isset($_GET['order_id'])) {
            $order_id = $_GET['order_id'];

            // Retrieve the order details from tbl_orderdetails table
            $sql = "SELECT od.product_id, p.product_title, p.product_description, p.product_price, p.product_imgname, od.order_quantity
                    FROM tbl_orderdetails od
                    INNER JOIN tbl_products p ON od.product_id = p.product_id
                    WHERE od.order_id = $order_id";
            $result = mysqli_query($conn, $sql);

            // Check if any order details found
            if (mysqli_num_rows($result) > 0) { ?>
                <table class="order-details">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['product_id']; ?></td>
                                <td><?php echo $row['product_title']; ?></td>
                                <td><?php echo $row['product_description']; ?></td>
                                <td><?php echo $row['product_price']; ?></td>
                                <td><img src="../../adminpanel/view/assets/Product_images/<?php echo $row['product_imgname']; ?>" alt="Product Image" class="product-image"></td>
                                <td><?php echo $row['order_quantity']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php
            } else {
                // Display a message when no order details found
                echo '<p>No order details found.</p>';
            }
        } else {
            // Display a message when order ID is not set
            echo '<p>Invalid order ID.</p>';
        }
        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- View Orders Section Ends Here -->

<!-- Footer Section Starts Here -->
<?php include('footer.php'); ?>
<!-- Footer Section Ends Here -->
