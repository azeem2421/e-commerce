<?php
	include ('../model/connection.php');
	

	if(isset($_GET['category_id']) AND isset($_GET['category_imgname']))
	{
		$category_id=$_GET['category_id'];
		$category_imgname=$_GET['category_imgname'];

		if ($category_imgname!= "") 
		{
			$path = "../view/assets/Category_images/".$category_imgname;

			$remove = unlink($path);

			if ($remove==false) 
			{
				echo '<script type="text/javascript">'; 
				echo 'alert("FAILED TO DELETE CATEGORY");'; 
				echo 'window.location.href = "../view/category.php";';
				echo '</script>';
				die();
			}
		}
	
		$sql = "DELETE FROM tbl_category WHERE category_id=$category_id";

		$res = mysqli_query($conn, $sql);
	 

	


		if($res==true)
		{
			echo '<script type="text/javascript">'; 
			echo 'alert("CATEGORY DELETED");'; 
			echo 'window.location.href = "../view/category.php";';
			echo '</script>';
		}
		else
		{
			echo '<script type="text/javascript">'; 
			echo 'alert("FAILED TO DELETE CATEGORY");'; 
			echo 'window.location.href = "../view/category.php";';
			echo '</script>';
		}

	}
	else
	{
			echo '<script type="text/javascript">'; 
			echo 'alert("FAILED TO DELETE CATEGORY");'; 
			echo 'window.location.href = "../view/category.php";';
			echo '</script>';
	}
?>

