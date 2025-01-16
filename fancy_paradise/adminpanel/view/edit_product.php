<?php include "index.php"; ?>
<style>
  <?php include "css/edit_product.css"; ?>
</style>

<?php
if (isset($_GET['product_id'])) {
  $product_id = $_GET['product_id'];
  $sql2 = "SELECT * FROM tbl_products WHERE product_id=$product_id";
  $res2 = mysqli_query($conn, $sql2);
  $row2 = mysqli_fetch_assoc($res2);
  $product_title = $row2['product_title'];
  $product_description = $row2['product_description'];
  $product_price = $row2['product_price'];
  $current_image = $row2['product_imgname'];
  $current_category = $row2['category_id'];
  $product_active = $row2['product_active'];
} else {
  header('location: ' . SITEURL . 'adminpanel/view/product.php');
  exit();
}
?>

<main>
  <h2 class="sticky">EDIT PRODUCT</h2>

  <form action="" method="POST" enctype="multipart/form-data">
    <table>
      <tr>
        <td>Product Name:</td>
        <td>
          <input type="text" name="product_title" value="<?php echo $product_title; ?>" placeholder="Product Name" required>
        </td>
      </tr>
      <tr>
        <td>Product Description:</td>
        <td>
          <textarea rows="5" cols="30" name="product_description" placeholder="Product Description" required><?php echo $product_description; ?></textarea>
        </td>
      </tr>
      <tr>
        <td>Current Image:</td>
        <td>
          <img src="<?php echo SITEURL; ?>adminpanel/view/assets/Product_images/<?php echo $current_image; ?>" width="200px">
        </td>
      </tr>
      <tr>
        <td>Select New Image:</td>
        <td>
          <input type="file" name="product_imgname">
        </td>
      </tr>
      <tr>
        <td>Category:</td>
        <td>
          <select name="category_id">
            <?php
            $sql = "SELECT * FROM tbl_category WHERE category_active='Yes'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count > 0) {
              while ($row = mysqli_fetch_assoc($res)) {
                $category_id = $row['category_id'];
                $category_title = $row['category_title'];
                $selected = ($current_category == $category_id) ? 'selected' : '';
                echo "<option value='$category_id' $selected>$category_title</option>";
              }
            } else {
              echo "<option value='0'>No Category Found</option>";
            }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Price:</td>
        <td>
          <input type="number" name="product_price" value="<?php echo $product_price; ?>" placeholder="Price" required>
        </td>
      </tr>
      <tr>
        <td><b>Active in Products:</b></td>
        <td>
          <input type="radio" name="product_active" value="Yes" <?php if ($product_active == "Yes") echo "checked"; ?> required> Yes
          <input type="radio" name="product_active" value="No" <?php if ($product_active == "No") echo "checked"; ?>> No
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
          <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
          <input type="submit" name="submit" value="Update" class="savebtn">
        </td>
      </tr>
    </table>
  </form>
</main>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
  $product_id = $_POST['product_id'];
  $product_title = $_POST['product_title'];
  $product_description = $_POST['product_description'];
  $product_price = $_POST['product_price'];
  $current_image = $_POST['current_image'];
  $category_id = $_POST['category_id'];
  $product_active = $_POST['product_active'];

  if (isset($_FILES['product_imgname']['name'])) {
    $product_imgname = $_FILES['product_imgname']['name'];
    if ($product_imgname != "") {
      $source_path = $_FILES['product_imgname']['tmp_name'];
      $destination_path = "assets/Product_images/".$product_imgname;
      $upload = move_uploaded_file($source_path, $destination_path);
      if ($upload == false) {
        echo '<script type="text/javascript"> alert("Failed To Upload Image")</script>';
        die();
      }
      if ($current_image != "") {
        $remove_path = "assets/Product_images/".$current_image;
        $remove = unlink($remove_path);
        if ($remove == false) {
          echo '<script type="text/javascript">';
          echo 'alert("FAILED TO REMOVE IMAGE");';
          echo 'window.location.href = "../view/products.php";';
          echo '</script>';
          die();
        }
      } else {
        $product_imgname = $current_image;
      }
    } else {
      $product_imgname = $current_image;
    }
  }

  $sql3 = "UPDATE tbl_products SET
     product_title = '$product_title',
     product_description = '$product_description',
     product_price = '$product_price',
     product_imgname = '$product_imgname',
     category_id  = '$category_id',
     product_active  = '$product_active'
     WHERE product_id=$product_id";

  $res3 = mysqli_query($conn, $sql3);

  if ($res3 == true) {
    echo '<script type="text/javascript">';
    echo 'alert("PRODUCT DETAILS UPDATED SUCCESSFULLY");';
    echo 'window.location.href = "../view/products.php";';
    echo '</script>';
  } else {
    echo '<script type="text/javascript">';
    echo 'alert("FAILED TO UPDATE PRODUCT DETAILS");';
    echo 'window.location.href = "../view/products.php";';
    echo '</script>';
  }
}
?>
<! ------------------------------ Button Click Functionality Ends ------------------------------>