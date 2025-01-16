<?php
ob_start(); // Start output buffering
?>
<!-- Header Section Starts Here -->
<?php include('header.php') ?>
<!-- Header Section Ends Here -->

<style>
    <?php
    include('css/style.css');
    include('css/header.css');
    ?>
</style>

<?php
$pagelink = $_SERVER['REQUEST_URI'];

error_reporting(E_ERROR | E_WARNING | E_PARSE); // Error Handling

session_start();

if (!isset($_SESSION['s_id'])) {
    // To get IP address
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $_SESSION['s_id'] = time() . "_" . $ip;
}

$s_id = $_SESSION['s_id'];
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <?php
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        ?>
        <h2>Search result <a href="#"><?php echo $search; ?></a></h2>
    </div>


</section>
<!-- fOOD sEARCH Section Ends Here -->
<section class="product-menu">
    <div class="container">
        <?php
        //get the searched keyword
        $search = isset($_POST['search']) ? $_POST['search'] : '';

        $sql = "SELECT * FROM tbl_products WHERE product_title LIKE '%$search%' OR product_description LIKE '%$search%'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_price = $row['product_price'];
                $product_imgname = $row['product_imgname'];
                $product_quantity = $row['product_quantity'];
                ?>
                <div class="product-menu-box">
                    <div class="product-menu-img">
                        <img src="<?php echo SITEURL; ?>adminpanel/view/assets/Product_images/<?php echo $product_imgname; ?>"
                        alt="<?php echo $product_title; ?>" class="img-responsive img-curve">
                    </div>

                    <div class="product-menu-desc">
                        <h4><?php echo $product_title; ?></h4>
                        <p class="product-price"><?php echo $product_price; ?></p>
                        <p class="product-detail">
                            <?php echo $product_description; ?>
                        </p>
                        <br>
                        <form action="../controller/cartcontroller.php" method="post">
                            <?php if ($product_quantity == 0): ?>
                                <label for="quantity" style="opacity: 0.5;">Out of Stock</label>
                            <?php else: ?>
                                <label for="quantity" style="opacity: 0.5;">Quantity Available <?php echo $product_quantity; ?></label>
                                <input type="hidden" name="product_id" id="product_id" value="<?php echo $product_id; ?>">
                                <input type="hidden" name="product_price" id="product_price" value="<?php echo $product_price; ?>">
                                <input type="hidden" name="s_id" id="s_id" value="<?php echo $s_id; ?>">
                                <input type="hidden" name="pagelink" value="<?php echo $pagelink; ?>">
                                <input type="number" name="product_quantity" id="product_quantity" value="1" min="1" max="<?php echo $product_quantity; ?>" required>
                                <br><br>
                                <div class="addtocartcon">
                                    <span class="material-icons-outlined">add</span>
                                    <input type="submit" class="addtocartbtn" value="ADD TO CART">
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        <div class="clearfix"></div>
    </div>
</section>

<!-- Footer Section Starts Here -->
<?php include('footer.php'); ?>

<style>
    <?php include('css/footer.css') ?>
</style>
<!-- Footer Section Ends Here -->
