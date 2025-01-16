<!--------------------------Start Navigation-------------------------->
      			<?php
      				include "index.php";
      			?>
			     <style>
      		  <?php include "css/edit_category.css"; ?>
        	 </style>

  
	<!--------------------------End Navigation-------------------------->

	<!--------------------------Getting data starts -------------------------->  
      <?php
          if (isset($_GET['category_id'])) 
          {
                $category_id = $_GET['category_id'];

                $sql = "SELECT * FROM tbl_category WHERE category_id=$category_id";

                $res = mysqli_query($conn,$sql);

                $count = mysqli_num_rows($res);

                if($count==1)
                {
                  $row=mysqli_fetch_assoc($res);

                  $category_title = $row['category_title'];
                  $current_image = $row['category_imgname'];
                  $category_featured = $row['category_featured'];
                  $category_active = $row['category_active'];
                }
                else
                {
                  echo '<script type="text/javascript">'; 
                  echo 'alert("CATEGORY NOT FOUND");'; 
                  echo 'window.location.href = "../view/category.php";';
                  echo '</script>';
                }
            }
            else
            {
                header('location:'.SITEURL.'adminpanel/view/category.php');
            }
        
      ?>
<!--------------------------Getting data Ends -------------------------->

		<main>
				
				<h1 class="sticky"><i class="fa fa-edit"></i> EDIT CATEGORY</h1>


					<form action="" method="POST" enctype="multipart/form-data">
  				<table>
  					<tr>
  						<td><b>Title: </b></td>
  						<td>
  							<input type="text" name="category_title" value="<?php echo $category_title; ?>"  required>
  						</td>
  					</tr>

            <tr>
              <td><b>Current Image: </b></td>
              <td>
                  <?php
                    if($current_image != "")
                      {
                        ?>
                        <img src="<?php echo SITEURL;?>adminpanel/view/assets/Category_images/<?php echo $current_image; ?>" width="200px">
                        <?php
                      }
                  ?>                  
                     </td>
            </tr>

            <tr>
              <td><b>New Image: </b></td>
              <td>

                  <input type="file" name="category_imgname">

              </td>
            </tr>

  					<tr>
  						<td><b>Featured in Home Page: </b></td>
  						<td>
  							<input <?php if($category_featured=="Yes") {echo "checked";}?> type="radio" name="category_featured" value="Yes"> Yes
                <input <?php if($category_featured=="No")  {echo "checked";}?> type="radio" name="category_featured" value="No"> No
  						</td>
  					</tr>

            <tr>
              <td><b>Active in Category: </b></td>
              <td>
                <input <?php if($category_active=="Yes") {echo "checked";}?> type="radio" name="category_active" value="Yes"> Yes
                <input <?php if($category_active=="No")  {echo "checked";}?> type="radio" name="category_active" value="No"> No
              </td>
            </tr>

  					<tr>
  						<td colspan="2" align="center">
                      <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                      <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                    	<input type="submit" name="submit" value="Update Category" class="savebtn">
  						</td>
  						
  					</tr>
  				</table>

  			</form>


        <! ------------------------------ Button Click Functionality Starts ------------------------------>
<?php
  if(isset($_POST['submit'])) 
    {
       $category_id = $_POST['category_id'];
       $category_title = $_POST['category_title'];
       $current_image = $_POST['current_image'];
       $category_featured = $_POST['category_featured'];
       $category_active = $_POST['category_active'];

      
       if (isset($_FILES['category_imgname']['name'])) 
       {
          $category_imgname=$_FILES['category_imgname']['name'];
       
        //check image available or not
          if($category_imgname !="")
          {                             
            //upload new image
                           $source_path = $_FILES['category_imgname']['tmp_name'];

                           $destination_path = "assets/Category_images/".$category_imgname;

                           $upload = move_uploaded_file($source_path, $destination_path);


                         if ($upload==false) 
                          {
                           echo '<script type="text/javascript"> alert("Failed To Upload Image")</script>';
                           die();
                          } 
                      
                       //remove current image
                        if ($current_image!="") 
                        {
                          $remove_path = "assets/Category_images/".$current_image;
                          $remove= unlink($remove_path);

                            if ($remove==false) 
                            {
                              echo '<script type="text/javascript">'; 
                              echo 'alert("FAILED TO REMOVE IMAGE");'; 
                              echo 'window.location.href = "../view/category.php";';
                              echo '</script>';
                              die();
                            }
                        }
                        else
                        {
                          $category_imgname = $current_image;
                        }
              }
            
              else
              {
                $category_imgname  = $current_image;
              }
          }
        //update database
       $sql2 = "UPDATE tbl_category SET
       category_title = '$category_title',
       category_imgname = '$category_imgname',
       category_featured = '$category_featured',
       category_active = '$category_active' 
       WHERE category_id=$category_id
       ";

       $res2 = mysqli_query($conn, $sql2);

         if ($res2==true) 
         {
          echo '<script type="text/javascript">'; 
          echo 'alert("CATEGORY DETAILS UPDATED SUCCESSFULLY");'; 
          echo 'window.location.href = "../view/category.php";';
          echo '</script>';
         }
         else
         {
          echo '<script type="text/javascript">'; 
          echo 'alert("FAILED TO UPDATE CATEGORY DETAILS");'; 
          echo 'window.location.href = "../view/category.php";';
          echo '</script>';
         }

    }
     

?>  
  <! ------------------------------ Button Click Functionality Ends ------------------------------>


</body>
</html>