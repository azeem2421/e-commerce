<!--------------------------Start Navigation-------------------------->
      <?php include "index.php"; ?>
        <style>
      <?php include "css/add_category.css"; ?>
        </style>

      


    
  <!--------------------------End Navigation-------------------------->
  <main>
  <h2 class="sticky">ADD CATEGORY</h2>
<!-- <h1 class="heading"> our <span>products</span> </h1> -->
  			<form action="" method="POST" enctype="multipart/form-data">
  				<table>
  					<tr>
  						<td><b>Title: </b></td>
  						<td>
  							<input type="text" name="category_title" style="text-transform: uppercase;"  required>
  						</td>
  					</tr>

            <tr>
              <td><b>Upload Image: </b></td>
              <td>
                <input type="file" name="category_imgname"  required>
              </td>
            </tr>

  					<tr>
  						<td><b>Featured in Home Page: </b></td>
  						<td>
  							<input type="radio" name="category_featured" value="Yes"  required> Yes
                <input type="radio" name="category_featured" value="No" required> No
  						</td>
  					</tr>

            <tr>
              <td><b>Active in Category: </b></td>
              <td>
                <input type="radio" name="category_active" value="Yes"  required> Yes
                <input type="radio" name="category_active" value="No" required> No
              </td>
            </tr>

  					<tr>
  						<td colspan="2" align="center"><input type="reset" value="Clear" class="cancelbtn">
  										<input type="submit" name="submit" value="Add Category" class="savebtn">
  						</td>
  						
  					</tr>
  				</table>

  			</form>


</body>
</html>

<!------------------------------ Insert Category input form details to database starts ------------------------------>
    <?php
        if (isset($_POST['submit'])) 
        {

            //Get the Data from form
            $category_title = $_POST['category_title'];            
            $category_featured = $_POST['category_featured'];            
            $category_active = $_POST['category_active'];   
            

            //Check image is selected or not and set image name
            if (isset($_FILES['category_imgname']['name']))
                {

                    //Upload image
                    //get image name, source path and destination path to upload image
                    $category_imgname = $_FILES['category_imgname']['name'];


                   if($category_imgname !="")
                    {

                            $source_path = $_FILES['category_imgname']['tmp_name'];

                            $destination_path = "assets/Category_images/".$category_imgname;

                            $upload = move_uploaded_file($source_path, $destination_path);


                          if ($upload==false) 
                          {
                            echo '<script type="text/javascript"> alert("Failed To Upload Image")</script>';
                            die();
                            }
                        
                    }

                }
            else
            {
              $category_imgname = "";
            } 
            
            strtoupper($category_title);

            $sql = "INSERT INTO tbl_category SET
                category_title='$category_title',
                category_imgname='$category_imgname',
                category_featured='$category_featured',
                category_active='$category_active'
            ";


            //Execute query and save data in database
            $res = mysqli_query($conn, $sql);


            if ($res==true)
             {
              echo '<script type="text/javascript"> alert("Category added Successfully")</script>';

             }
             else
             {
              echo '<script type="text/javascript"> alert("Failed To add Category")</script>';

             }
        }
       
    ?>

<!------------------------------ Insert Category input form details to database Ends ------------------------------>