   <!-- Header Section Starts Here -->

        <?php include('header.php'); ?>
    
    <!-- Header Section Ends Here -->  

        <style>
            <?php
            include('css/style.css');
            include('css/header.css');
            ?>
        </style>

    <!-- Navbar Section Ends Here -->

    



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Categories</h2>

            <?php 
                $sql = "SELECT * FROM tbl_category WHERE category_active='Yes'";

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
                                <img src="<?php echo SITEURL; ?>adminpanel/view/assets/Category_images/<?php echo $category_imgname; ?>" alt="" class="img-responsive img-curve">

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

