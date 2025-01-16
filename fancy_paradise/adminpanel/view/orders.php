<!--------------------------Start Navigation-------------------------->
<?php
    include "index.php";
?>
<style>
    <?php include "css/orders.css"; ?>
</style>
<!--------------------------End Navigation-------------------------->

<main>
    <h1 class="sticky"><i class="fa fa-bars" aria-hidden="true"></i> ORDERS</h1>
    <br><br>

    <br><br>

    <div class="order-tabs">
        <ul>
            <li class="tab-link" data-tab="all">All</li>
            <li class="tab-link" data-tab="pending">Pending</li>
            <li class="tab-link" data-tab="processing">Processing</li>
            <li class="tab-link" data-tab="ready">Ready</li>
            <li class="tab-link" data-tab="dispatched">Dispatched</li>
            <li class="tab-link" data-tab="delivered">Delivered</li>
        </ul>
    </div>

    <?php
    $sql="SELECT * FROM tbl_order o, tbl_customer c WHERE o.customer_id=c.customer_id ";
    $res = mysqli_query($conn, $sql);
    ?>

    <table class="order-table hover order-colomn cell-border order-display">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Order Payment Type</th>
                <th>Order Total</th>
                <th>Order Date</th>
                <th>Order Status</th>
                <th>Delivery Address</th>
                <th>City ID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($res)) {
                $order_id = $row['order_id'];
                $customer_name = $row['first_name'] . ' ' . $row['last_name'];
                $order_pay_type = $row['order_pay_type'];
                $order_total = $row['order_total'];
                $order_datetime = $row['order_datetime'];
                $order_status = $row['order_status'];
                $delivery_address = $row['delivery_address'];
                $city_id = $row['city_id'];
            ?>

                <tr data-status="<?php echo strtolower($order_status); ?>">
                    <td><?php echo $order_id; ?></td>
                    <td><?php echo $customer_name; ?></td>
                    <td><?php echo $order_pay_type; ?></td>
                    <td><?php echo $order_total; ?></td>
                    <td><?php echo $order_datetime; ?></td>
                    <td><?php echo $order_status; ?></td>
                    <td><?php echo $delivery_address; ?></td>
                    <td><?php echo $city_id; ?></td>
                    <td>
                        <a href="#" class="vieworder" data-orderid="<?php echo $order_id; ?>">View</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

<!-- Popup Modal -->
<div id="orderModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="orderDetails"></div>
    </div>
</div>

<!-- Display orders starts -->
<script>
    $(document).ready(function () {
        var table = $('.order-table').DataTable({
            "dom": 'lBfrtip',
            "buttons": [
                'copyHtml5',
                'excelHtml5',
                'pdfHtml5'
            ],
            "lengthMenu": [10, 20, 50, 100] // Define the available page lengths
        });

        // Add event listener for tab links
        $('.tab-link').on('click', function () {
            var tab = $(this).data('tab');

            // Remove active class from all tab links
            $('.tab-link').removeClass('active');

            // Add active class to the clicked tab link
            $(this).addClass('active');

            // Show/hide rows based on selected tab
            if (tab === 'all') {
                table.columns().search('').draw();
            } else {
                table.columns(5).search(tab, false, true).draw();
            }
        });

        // Handle "View" link clicks
        $('.vieworder').on('click', function (e) {
            e.preventDefault();

            // Get the order ID from the clicked link
            var orderID = $(this).data('orderid');

            // Fetch the order details using AJAX
            $.ajax({
                url: 'vieworder.php',
                type: 'GET',
                data: {
                    order_id: orderID
                },
                success: function (response) {
                    // Update the order details in the popup modal
                    $('#orderDetails').html(response);
                    $('#orderModal').css('display', 'block');
                },
                error: function () {
                    alert('Error retrieving order details.');
                }
            });
        });

        // Close the popup modal
        $('.close').on('click', function () {
            $('#orderModal').css('display', 'none');
        });
    });
</script>
<!-- Display orders ends -->

</body>
</html>
