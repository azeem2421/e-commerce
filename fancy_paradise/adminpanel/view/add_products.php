<?php include "index.php"; ?>
<style>
  <?php include "css/add_products.css"; ?>
</style>

<main>
  <h2 class="sticky">ADD PRODUCTS</h2>

  <form action="" method="POST" enctype="multipart/form-data">
    <table>
      <tr>
        <td>Product Name: </td>
        <td><input type="text" name="product_title" placeholder="Product Name" required></td>
      </tr>
      <tr>
        <td>Product Description: </td>
        <td><textarea rows="5" cols="30" name="product_description" placeholder="Product Description" required></textarea></td>
      </tr>
      <tr>
        <td>Select Category: </td>
        <td>
          <select name="category" required>
            <option value="">Please Select a Category</option>
            <?php
            $sql = "SELECT * FROM tbl_category WHERE category_active='Yes'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count > 0) {
              while ($row = mysqli_fetch_assoc($res)) {
                $category_id = $row['category_id'];
                $category_title = $row['category_title'];
                echo "<option value='$category_id'>$category_title</option>";
              }
            } else {
              echo "<option value='0'>No Category Found</option>";
            }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Price: </td>
        <td><input type="number" name="product_price" placeholder="Price" required></td>
      </tr>
      <tr>
        <td>Upload Image: </td>
        <td><input type="file" name="product_imgname" id="product_imgname" accept=".jpg, .jpeg, .png, .webp" onchange="validateFileType()" required></td>
      </tr>
      <tr>
        <td><b>Active in Products: </b></td>
        <td>
          <input type="radio" name="product_active" value="Yes" required> Yes
          <input type="radio" name="product_active" value="No" required> No
        </td>
      </tr>
      <tr>
        <td colspan="2" align="center">
          <input type="reset" value="Cancel" class="cancelbtn">
          <input type="submit" name="submit" value="Add" class="savebtn">
        </td>
      </tr>
    </table>
  </form>
</main>

<?php
if (isset($_POST['submit'])) 
{
  // Code for inserting the form input into the database
  $product_title = $_POST['product_title'];
  $product_description = $_POST['product_description'];
  $product_price = $_POST['product_price'];
  $category = $_POST['category'];
  $product_active = $_POST['product_active'];

  //upload image
  if (isset($_FILES['product_imgname']['name'])) 
  {
    $product_imgname = $_FILES['product_imgname']['name'];


    if($product_imgname !="")
    {
      
      $source_path = $_FILES['product_imgname']['tmp_name'];

      $destination_path = "assets/Product_images/".$product_imgname;

      $upload = move_uploaded_file($source_path, $destination_path);

      if ($upload==false)
      {
        echo '<script type="text/javascript"> alert("Failed To Upload Image")</script>';
        header('location:'.SITEURL.'adminpanel/view/add_products.php');
        die();
      }
    }
  }
  else
  {
    $product_imgname ="";
  }

  //insert into database
  $sql2 = "INSERT INTO tbl_products SET
    product_title = '$product_title',
    product_description = '$product_description',
    product_price = '$product_price',
    product_imgname = '$product_imgname',
    category_id = '$category_id',
    product_active = '$product_active'
  ";

  $res2 = mysqli_query($conn, $sql2);

  if($res2 ==true)
  {
    echo '<script type="text/javascript"> alert("Product added Successfully")</script>';
  }
  else
  {
    echo '<script type="text/javascript"> alert("Failed To Add Product")</script>';
    header('location:'.SITEURL.'adminpanel/view/add_products.php');
  }
  
}


?>

<script type="text/javascript">
  function validateFileType() {
    var fileInput = document.getElementById("product_imgname");
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.webp)$/i;
    if (!allowedExtensions.exec(filePath)) {
      alert("Only jpg/jpeg and png files are allowed!");
      fileInput.value = "";
      return false;
    }
  }
</script>