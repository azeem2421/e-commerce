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

<!-- User Profile Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">User Profile</h2>

        <?php
      
        if(isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];

            
            $sql = "SELECT * FROM tbl_customer c,tbl_cuslogin cl WHERE c.customer_id=cl.customer_id AND user_id = '$user_id'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            if($row) {
                $title = $row['title'];
                $firstName = $row['first_name'];
                $lastName = $row['last_name'];
                $address = $row['address'];
                $telephone = $row['telephone_no'];
                $email = $row['email'];
                
                ?>
                    <table class="customerdetails">
                        
                            <tr>
                                <th colspan='3'>Title:</th>
                                <td><?php echo $title ?></td>
                            </tr>
                            <tr>
                                <th colspan='3'>First Name:</th>
                                <td><?php echo $firstName ?></td>
                            </tr>
                            <tr>
                                <th colspan='3'>Last Name:</th>
                                <td><?php echo $lastName ?></td>
                            </tr>
                            <tr>
                                <th colspan='3'>Address:</th>
                                <td><?php echo $address ?></td>
                            </tr>
                            <tr>
                                <th colspan='3'>Telephone Number:</th>
                                <td><?php echo $telephone ?></td>
                            </tr>
                            <tr>
                                <th colspan='3'>Email:</th>
                                <td><?php echo $email ?></td>
                            </tr>                            
                        
                    </table>
                
                <?php
            } 
        } 
        ?>

        <a href="<?php echo SITEURL; ?>website/view/customerorders.php?user_id=<?php echo $user_id; ?>">View Orders</a>


        <div class="clearfix"></div>
    </div>
</section>
<!-- User Profile Section Ends Here -->

<!-- Footer Section Starts Here -->
<?php include('footer.php'); ?>
<!-- Footer Section Ends Here -->
