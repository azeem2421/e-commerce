    <!-- Header Section Starts Here -->

        <?php include('header.php') ?>
	
    <!-- Header Section Ends Here -->  

        <style>
            <?php
            include('css/style.css');
            include('css/header.css');
            ?>
        </style>




	<!-- Fancy Item Search Section Starts Here -->
    <section class="fancy-items-search text-center">
    	<div class="container">
            
            <form action="<?php echo SITEURL; ?>website/view/product_search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Products.." class="search" required>
                <input type="submit" name="submit" value="Search" class="searchbtn">
            </form>

        </div>
    </section>
    <!-- Fancy Item Search Section Ends Here -->

     <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Fancy Items</h2>

            <?php
                $sql = "SELECT * FROM tbl_category WHERE category_active='Yes' AND category_featured='Yes' LIMIT 3";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $category_id = $row['category_id'];
                        $category_title = $row['category_title'];
                        $category_imgname = $row['category_imgname'];
                        ?>

                    <a href="<?php echo SITEURL; ?>website/view/category_products.php?category_id=<?php echo $category_id; ?>">
                        <div class="box-3 float-container">
                            <img src="<?php echo SITEURL; ?>adminpanel/view/assets/Category_images/<?php echo $category_imgname; ?>" alt="skin care items" class="img-responsive img-curve">

                            <h3 class="text-black text-center"><?php echo $category_title; ?></h3>
                        </div>
                    </a>



                        <?php

                    }
                }
            ?>

            

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


<script>
    function logoutAnimation() {
        Swal.fire({
            title: 'Logging Out...',
            html: 'Please wait while we log you out.',
            allowOutsideClick: false,
            showConfirmButton: false,
            timer: 9000, 
            onBeforeOpen: () => {
                Swal.showLoading();
            }
        }).then(() => {
          
            window.location.href = '<?php echo SITEURL; ?>website/view/logout.php';
        });
    }
</script>



    <!-- Footer Section Starts Here -->

        <?php 

            include('footer.php');

        ?>

        <style>
            <?php
            include('css/footer.css')
            ?>
        </style>

    <!-- Footer Section Ends Here -->
