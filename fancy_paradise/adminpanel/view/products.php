	<!--------------------------Start Navigation-------------------------->
			<?php
			include "index.php";

			?>

			<style>
      		<?php include "css/products.css"; ?>
        	</style>

		
	<!--------------------------End Navigation-------------------------->

		<main>
				
			<h1 class="sticky"><i class="fa fa-archive" aria-hidden="true"></i> PRODUCTS
                    </h1>
            

                </br>
                </br>
                    <a href="add_products.php"  class="add-products-btn">ADD PRODUCTS <i class="fa fa-plus"></i></a> 
                    
                    <a href="add_stock.php"  class="add-products-btn">ADD STOCK <i class="fa fa-plus"></i></a>
                </br>
                </br>

                <?php
                $sql = "SELECT * FROM tbl_products p, tbl_category c WHERE p.category_id=c.category_id ";

                $res = mysqli_query($conn, $sql);
                

                
                ?>
                
				 <table class="products-table hover order-colomn cell-border product-display">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Price</th>  
                                <th>Product Image</th>
                                <th>Quantity</th>                                                                                
                                <th>Active in Products Page</th>
                                <th>Category</th>
                                <th>Actions</th>
                                
            

                            </tr>
                        </thead>
        <tbody>
                    <?php
                        while ($row=mysqli_fetch_assoc($res)) 
                        {
                            $product_id = $row['product_id'];
                            $product_title = $row['product_title'];
                            $product_description = $row['product_description'];
                            $product_price = $row['product_price'];
                            $product_imgname = $row['product_imgname'];
                            $product_quantity = $row['product_quantity'];
                            $product_active = $row['product_active'];
                            $category_id = $row['category_id'];
                            $category_title = $row['category_title'];
                            


                            ?>
                    
                    <tr>
                        <td><b><?php echo $row['product_title'] ?></b></td>

                        <td><?php echo $row['product_description'] ?></td>

                        <td><?php echo $row['product_price'] ?></td> 

                        <td><img src="<?php echo SITEURL;?>adminpanel/view/assets/Product_images/<?php echo $product_imgname; ?>" width="200px"></td>

                        <td><?php echo $row['product_quantity'] ?></td>                          

                        <td><?php echo $row['product_active'] ?></td>

                        <td><?php echo $row['category_title'] ?></td>
                        
                        <td align="center">
                            <a href="<?php echo SITEURL; ?>adminpanel/view/edit_product.php?product_id=<?php echo $product_id; ?>" class="update-button">Edit Product <i class="fa fa-edit"></i></a> <br><br>
                            <a href="<?php echo SITEURL; ?>adminpanel/controller/delete_product.php?product_id=<?php echo $product_id; ?>&product_imgname=<?php echo $product_imgname; ?>" onclick="checkdelete()" class="delete-button">Delete <i class="fa fa-edit"></i></a>
                            </td>

                    </tr>
                    <?php } ?>

    </tbody>
</table>

</body>
</html> 
    

<!---------display products starts----->    
<script>
    $(document).ready(function () {
        var currentDate = new Date().toISOString().slice(0, 10); // Get current date in the format "YYYY-MM-DD"
        var table = $('.products-table').DataTable({
            "dom": 'Bfrtip',
            "buttons": [
                'copyHtml5',
                'excelHtml5',
                {
                    extend: 'pdfHtml5',
                    filename: 'Orders_' + currentDate,
                }
            ]
        });
    });
</script>


<!---------display products ends----->





<!---------delete products function starts----->
<script>
    function checkdelete()
    {
        var result = confirm('are you sure want delete this product?');
        if (result == false)
            {
                event.preventDefault();
            }
    }
</script>
<!---------delete products function ends----->

