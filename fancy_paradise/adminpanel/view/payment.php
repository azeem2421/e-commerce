<!--------------------------Start Navigation-------------------------->
<?php
    include "index.php";
?>
<style>
    <?php include "css/orders.css"; ?>
</style>
<!--------------------------End Navigation-------------------------->

<main>
    <h1 class="sticky"><i class="fa fa-bars" aria-hidden="true"></i> PAYMENTS</h1>
    <br><br>
    

    <?php
    $sql="SELECT * FROM tbl_order o, tbl_customer c, tbl_ordertracking ot, tbl_payment p WHERE o.customer_id=c.customer_id AND o.order_id=ot.ordertracking_order_id AND o.order_id=p.order_id";
    $res = mysqli_query($conn, $sql);
    ?>

    <table class="payment-table hover payment-colomn cell-border payment-display">
        <thead>
            <tr>
                <th>Payment ID</th>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Reference No</th>
                <th>Payment Type</th>
                <th>Payment Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($res)) {
                $payment_id = $row['payment_id'];
                $order_id = $row['order_id'];
                $customer_name = $row['first_name']. ' ' . $row['last_name'];
                $reference_no = $row['reference_no'];
                $payment_type = $row['payment_type'];
                $payment_total = $row['payment_total'];
            ?>

                <tr data-status="<?php echo strtolower($payment_status); ?>">
                    <td><?php echo $payment_id; ?></td>
                    <td><?php echo $order_id; ?></td>
                    <td><?php echo $customer_name; ?></td>
                    <td><?php echo $reference_no; ?></td>
                    <td><?php echo $payment_type; ?></td>
                    <td><?php echo $payment_total; ?></td>
                    <td></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

<!-- Display payments starts -->
<script>
    $(document).ready(function () {
        var table = $('.payment-table').DataTable({
            "dom": 'lBfrtip',
            "buttons": [
                'copyHtml5',
                'excelHtml5',
                'pdfHtml5'
            ],
            "lengthMenu": [10, 20, 50, 100] // Define the available page lengths
        });
   
    });
</script>
<!-- Display payments ends -->

</body>
</html>
