<?php
include_once('../connection.php');
$response = array();
if(isset($_POST['delete']))
{
	if(isset($_POST['id']))
	{
		$sql_select = "select * from product_tbl where product_id = '".$_POST['id']."'";
		$resultView = mysqli_query($con,$sql_select);
		if(mysqli_num_rows($resultView) > 0)
		{
			while($rowView = mysqli_fetch_array($resultView))
			{
				$image1 = $rowView['product_logo'];
				$path = $_SERVER['DOCUMENT_ROOT'].'/tryon_project_btv/images/product_logo/';
				if (file_exists($path.$image1)) 
				{
					unlink($path.$image1);
				}				
			}
		}
		
		$deleteSql = "CALL deleteProduct('".$_POST['id']."')";
		if(mysqli_query($con,$deleteSql))
		{
			$response["Success"] = 1;
		}
		else
		{
			$response["Failsas"] = 1;
		}
	}		
}
else
{
	$response["Fail"] = 1;
}
echo json_encode($response);
?>