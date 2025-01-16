<?php
include('../model/connection.php');

if (isset($_GET['product_id']) && isset($_GET['product_imgname'])) {
    $product_id = $_GET['product_id'];
    $product_imgname = $_GET['product_imgname'];

    if ($product_imgname != "") {
        $path = "../view/assets/Product_images/".$product_imgname;
        $remove = unlink($path);

        if ($remove == false) {
            echo '<script type="text/javascript">';
            echo 'alert("FAILED TO DELETE PRODUCT");';
            echo 'window.location.href = "../view/products.php";';
            echo '</script>';
            die();
        }
    }

    $sql = "DELETE FROM tbl_products WHERE product_id = $product_id";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        echo '<script type="text/javascript">';
        echo 'alert("PRODUCT DELETED");';
        echo 'window.location.href = "../view/products.php";';
        echo '</script>';
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("FAILED TO DELETE PRODUCT");';
        echo 'window.location.href = "../view/products.php";';
        echo '</script>';
    }
} else {
    echo '<script type="text/javascript">';
    echo 'alert("FAILED TO DELETE PRODUCT");';
    echo 'window.location.href = "../view/products.php";';
    echo '</script>';
}
?>
