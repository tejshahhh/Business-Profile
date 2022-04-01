<?php
include_once('../connection.php');
$response = array();
if(isset($_POST['edit']))	
{
	if(isset($_POST['id']))
	{
		$fetchSql = "CALL fetchProduct('".$_POST['id']."')";
		$result = mysqli_query($con,$fetchSql);
			
		while($row = mysqli_fetch_array($result))
		{
			$response["product_title"] = $row["product_title"];
			$response["product_price"] = $row["product_price"];
			$response["product_description"] = $row["product_description"];	
			$response["product_image"] = $row["product_image"];		
		}		
	}		
}
else
{
	$response["Fail"] = 1;
}
echo json_encode($response);

?>