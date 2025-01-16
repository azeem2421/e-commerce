<?php
include "index.php";
?>

<style>
    <?php include "css/tracking.css"; ?>
    
</style>

<main>
    <h1 class="sticky"><i class="fa fa-bars" aria-hidden="true"></i> Login Details</h1>
    <br><br>

    <?php
    $sql = "SELECT * FROM tbl_userlog";
    $res = mysqli_query($conn, $sql);

    ?>

    <table class="login-table hover cell-border stripe login-display ">
        <thead>
            <tr>
                <th>Login ID</th>
                <th>Login Date and Time</th>
                <th>Logout Date and Time</th>
                <th>Login IP</th>
                <th>Login Status</th>
                <th>User</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($res)) {
                $login_id = $row['user_log_id'];
                $login_datetime = $row['login_datetime'];
                $logout_datetime = $row['logout_datetime'];
                $login_ip = $row['login_ip'];
                $login_status = $row['login_status'];
                $adminuser_id = $row['adminuser_id'];

                $sql2 = "SELECT * FROM tbl_adminuser WHERE adminuser_id='$adminuser_id'";
                $res2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($res2);

                $user_full_name = $row2['firstname'] . ' ' . $row2['lastname'];

                // Add a CSS class based on the login status
                
            ?>

                <tr data-status="<?php echo strtolower($login_status); ?>">
                    <td><?php echo $login_id; ?></td>
                    <td><?php echo $login_datetime; ?></td>
                    <td><?php echo $logout_datetime; ?></td>
                    <td><?php echo $login_ip; ?></td>
                    <td><?php echo $login_status; ?></td>
                    <td><?php echo $user_full_name; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

<!-- Display login details starts -->

<script>
    
    $(document).ready(function () {
    var currentDate = new Date().toISOString().slice(0, 10);
    var table = $('.login-table').DataTable({
        "dom": 'Bfrtip',
        "buttons": [
            'copyHtml5',
            'excelHtml5',
            {
                extend: 'pdfHtml5',
                filename: 'logintracking' + currentDate,
            }
        ],
 
    });
});


</script>
