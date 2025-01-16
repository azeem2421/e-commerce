<!--------------------------Start Navigation-------------------------->
<?php
    include "index.php";
?>

<style>
    <?php include "css/customer.css"; ?>
</style>

<main>
    <h1 class="sticky"><i class="fa fa-users" aria-hidden="true"></i> CUSTOMERS</h1>
    </br>
    </br>
    </br>
    </br>

    <?php
    $sql = "SELECT * FROM tbl_customer";

    $res = mysqli_query($conn, $sql);
    ?>

    <table class="customer-table hover order-colomn cell-border customer-display">
        <thead>
            <tr>
                <th>Title</th>
                <th>First Name</th>
                <th>Last Name</th>  
                <th>Address</th>
                <th>Telephone No</th>                                                                                
                <th>Email</th>
                <th>Added DateTime</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($res)) {
                $customer_id = $row['customer_id'];
                $title = $row['title'];
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $address = $row['address'];
                $telephone_no = $row['telephone_no'];
                $email = $row['email'];
                $added_datetime = $row['added_datetime'];
            ?>
                <tr>
                    <td><?php echo $title; ?></td>
                    <td><?php echo $first_name; ?></td>
                    <td><?php echo $last_name; ?></td>
                    <td><?php echo $address; ?></td>
                    <td><?php echo $telephone_no; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $added_datetime; ?></td>
                   
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</main>


</body>
</html> 
    

<!---------display products starts----->    
<script>
    $(document).ready(function () {
        var currentDate = new Date().toISOString().slice(0, 10); // Get current date in the format "YYYY-MM-DD"
        var table = $('.customer-table').DataTable({
            "dom": 'Bfrtip',
            "buttons": [
                'copyHtml5',
                'excelHtml5',
                {
                    extend: 'pdfHtml5',
                    filename: 'Orders_' + currentDate,
                }
            ]
        });
    });
</script>


<!---------display products ends----->
