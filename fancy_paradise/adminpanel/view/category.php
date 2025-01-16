<!--------------------------Start Navigation-------------------------->
      <?php include "index.php"; ?>
        <style>
      <?php include "css/category.css"; ?>
        </style>

      


    
  <!--------------------------End Navigation-------------------------->
  <main>
  <h1 class="sticky"><i class="fa fa-cubes" aria-hidden="true"></i> CATEGORY
                    </h1>
  

                        </br></br></br></br></br>
    
        </br>
        </br>
            <a href="add_category.php"  class="add-category-btn">ADD CATEGORY <i class="fa fa-plus"></i></a>
        </br>
        </br>

                
    <!------------------------------ Category Listing Table starts ------------------------------>
        <table class="category-display-form">
            <tr>
                <th>No.<br><hr></th>
                <th>Title<br><hr></th>
                <th>Image<br><hr></th> 
                <th>Featured<br><hr></th>
                <th>Active<br><hr></th>
                <th>Actions<br><hr></th>
                
            </tr>
        <!------------------------------ Fetch Data from Database starts ------------------------------>
        <?php 
            //query to get all user details
            $sql = "SELECT * FROM tbl_category";
            //execute the query
            $res = mysqli_query($conn,$sql);

            //check the execution
            $count = mysqli_num_rows($res);

            $no=1; //add a numbered list

            if ($count>0) 
            {
                while ($row=mysqli_fetch_assoc($res)) 
                {
                    $category_id = $row['category_id'];
                    $category_title = $row['category_title'];
                    $category_imgname = $row['category_imgname'];
                    $category_featured = $row['category_featured'];
                    $category_active = $row['category_active'];

                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $category_title; ?></td>
                        <td><img src="<?php echo SITEURL;?>adminpanel/view/assets/Category_images/<?php echo $category_imgname; ?>" width="200px"></td>
                        <td><?php echo $category_featured; ?></td>
                        <td><?php echo $category_active; ?></td>
                        <td><br>
                            <a href="<?php echo SITEURL; ?>adminpanel/view/edit_category.php?category_id=<?php echo $category_id; ?>" 
                            class="update-button">Edit Category <i class="fa fa-edit"></i></a>

                            <a href="<?php echo SITEURL; ?>adminpanel/controller/delete_category.php?category_id=<?php echo $category_id; ?>&category_imgname=<?php echo $category_imgname;?>" 
                            onclick="checkdelete()" class="delete-button">Delete Category <i class="fa fa-trash"></i></a><br><br>
                    
                        </td>
                    </tr>


                <?php 
                }

            }
            else
            {

                ?>
                <tr>
                    <td colspan="6"><div class="error">No Category Added.</div></td>
                </tr>
                <?php                            
        
            }

        ?>
                            
                            

    <!------------------------------ Fetch Data from Database Ends ------------------------------>


    
                                           
                                                         
                    </table>
    <!------------------------------ Category Listing Table Ends ------------------------------>
    </main>



</body>

</html>

<!---------delete category function starts----->
<script>
    function checkdelete()
    {
        var result = confirm('are you sure want to delete this category?');
        if (result == false)
            {
                event.preventDefault();
            }
    }
</script>
<!---------delete category function ends----->

 