<!--------------------------Start Navigation-------------------------->
<?php
include "index.php";


?>
<style>
    <?php include "css/users.css"; ?>
</style>

<!--------------------------End Navigation-------------------------->
<main>
    <h1 class="sticky">
        <i class="fa fa-users" aria-hidden="true"></i> USERS
    </h1>

    </br></br></br></br></br></br>

    <a href="add_user.php" class="add-user-btn">ADD USER <i class="fas fa-user-plus"></i></a>
    </br>
    </br>

    <!------------------------------ User Listing Table starts ------------------------------>
    <table class="user-display-form">
        <tr>
            <th>No.<br>
                <hr>
            </th>
            <th>First Name<br>
                <hr>
            </th>
            <th>Last Name<br>
                <hr>
            </th>
            <th>Username<br>
                <hr>
            </th>
            <th>Actions<br>
                <hr>
            </th>
            
        </tr>
        <!------------------------------ Fetch Data from Database starts ------------------------------>
        <?php
        $usersPerPage = 5;
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($currentPage - 1) * $usersPerPage;

        $sql = "SELECT * FROM tbl_adminlogin al, tbl_adminuser au WHERE al.adminuser_id=au.adminuser_id LIMIT $offset, $usersPerPage";
        $res = mysqli_query($conn, $sql);

        if ($res == TRUE) {
            $count = mysqli_num_rows($res);

            $no = 1 + $offset;

            if ($count > 0) {
                while ($rows = mysqli_fetch_assoc($res)) {
                    $admin_id = $rows['admin_id'];
                    $firstname = $rows['firstname'];
                    $lastname = $rows['lastname'];
                    $username = $rows['username'];
                    $status = $rows['status'];
                    
                    ?>

                    <!------------------------------ Fetch Data from Database Ends ------------------------------>

                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $firstname; ?></td>
                        <td><?php echo $lastname; ?></td>
                        <td><?php echo $username; ?></td>
                        <td>
                            <br>
                            <a href="<?php echo SITEURL; ?>adminpanel/view/change_password.php?adminuser_id=<?php echo $admin_id; ?>" class="change_password">Change Password <i class="fas fa-key"></i></a>

                            <a href="<?php echo SITEURL; ?>adminpanel/view/edit_user.php?adminuser_id=<?php echo $admin_id; ?>" class="update-button">Edit User <i class="fas fa-user-edit"></i></a>

                            <a href="../controller/userstatuscontroller.php?admin_id=<?php echo $admin_id; ?>&status=<?php echo $status; ?>">
                            <button class="status <?php echo strtolower($status); ?>"><?php echo $status; ?></button>
                        </a>
                        
                        </td>
                    </tr>
            <?php
                }
            }
        }
            ?>
    </table>
    <!------------------------------ User Listing Table Ends ------------------------------>

    
    <div class="pagination">
        <?php
        
        $totalUsersQuery = "SELECT COUNT(*) AS total FROM tbl_adminlogin";
        $totalUsersResult = mysqli_query($conn, $totalUsersQuery);
        $totalUsersRow = mysqli_fetch_assoc($totalUsersResult);
        $totalUsers = $totalUsersRow['total'];

        // Calculate the total number of pages
        $totalPages = ceil($totalUsers / $usersPerPage);

        // Generate pagination links
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href='users.php?page=$i'";
            if ($i == $currentPage) {
                echo " class='active'";
            }
            echo ">$i</a>";
        }
        ?>
    </div>

</main>

<script>
    function updateStatus(adminId, status) {
        var newStatus = status === 'Active' ? 'Deactive' : 'Active';
        var confirmation = confirm("Are you sure you want to change the status to " + newStatus + "?");

        if (confirmation) {
            // Redirect to userstatuscontroller.php to update the status
            window.location.href = "../controller/userstatuscontroller.php?admin_id=" + adminId + "&status=" + newStatus;
        }
    }
</script>

</body>

</html>
