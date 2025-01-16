

	<!--------------------------Start Navigation-------------------------->
  <?php
			include "index.php";

			?>

			<style>
      		<?php include "css/stock.css"; ?>
        	</style>

		
	<!--------------------------End Navigation-------------------------->

		<main>
				
			<h1 class="sticky"><i class="fa fa-archive" aria-hidden="true"></i> MANAGE PRODUCTS
                    </h1>
            

                </br>
                </br>
                    <a href="add_stock.php"  class="add-stock-btn">ADD STOCK <i class="fa fa-plus"></i></a>
                </br>
                </br>

                <?php
                //Display all stock
                $sql = "SELECT * FROM tbl_stock st,  tbl_products p WHERE st.product_id=p.product_id";

                $res = mysqli_query($conn, $sql);
                

                
                ?>
                
				 <table class="stock-table hover order-colomn cell-border product-display">
                        <thead>
                            <tr>
                                <th>Product Title</th>
                                <th>Product Image</th>
                                <th>Product Quantity</th>
                                
            

                            </tr>
                        </thead>
                <tbody>
                            <?php
                                while ($row=mysqli_fetch_assoc($res)) 
                                {
                                    $product_id = $row['product_id'];
                                    $product_title = $row['product_title'];
                                    $product_imgname = $row['product_imgname'];
                                    $stock_quantity = $row['stock_quantity'];
                                    ?>
                            
                            <tr>
                                <td><b><?php echo $row['product_title'] ?></b></td> 

                                <td><img src="<?php echo SITEURL;?>adminpanel/view/assets/Product_images/<?php echo $product_imgname; ?>" width="200px"></td>
                                                                
                                <td><?php echo $row['stock_quantity'] ?></td>
                                
                          <?php } ?>
                </tbody>
              </table>
   
    

<!---------display products starts----->    
<script>
    $(document).ready( function () {
    var table = $('.stock-table').DataTable();
    var tableTools = new $.fn.dataTable.TableTools(table, {
                'aButtons': [
                    {
                        'sExtends': 'xls',
                        'sButtonText': 'Save to Excel',
                        'sFileName': 'Data.xls'
                    },
                    {
                        'sExtends': 'print',
                        'bShowAll': true,
                    },
                    {
                        'sExtends': 'pdf',
                        'bFooter': false
                    },
                    'copy',
                    'csv'
                ],
                'sSwfPath': '//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf'
            });
            $(tableTools.fnContainer()).insertBefore('.stock-table_wrapper');
} );
</script>
<!---------display products ends----->




</body>
</html>