<?php
	include_once('../connection.php');
	$response = array();
	
	if(isset($_POST['pagging']))
	{
		$limit = 10;
		$page_no = "";				
		$start_from = 0;
		
		if(isset($_POST['page_no']))
		{
			$page_no = $_POST['page_no'];
			
			$start_from = ($page_no - 1) *  $limit;
		}
		
		$sql_filter = "SELECT pro.*, bus.firstname FROM product_tbl pro 
					   LEFT JOIN business_profile_tbl bus ON bus.business_id = pro.business_id
					   WHERE 1=1";
		
		if($_POST['start_date'] != '' && $_POST['end_date'] != '')
		{
			$sql_filter .= "     AND product_date BETWEEN '".$_POST['start_date']."' AND '".$_POST['end_date']."'    ";
		}
		
		if($_POST['business_id'] != '')
		{
			$sql_filter .= "      AND bus.business_id = '".$_POST['business_id']."'    ";
		}
		
		$count = $sql_filter;
		$sql_filter .= "    ORDER BY product_id DESC limit $start_from,$limit      ";
	
	}
	
	$run_filter = mysqli_query($con,$sql_filter);
	
		$total_records = mysqli_num_rows(mysqli_query($con,$count));
		 //echo $sql_records;
		if($total_records != 0)
		{
			while($row = mysqli_fetch_array($run_filter))
			{
				$product_id = $row['product_id'];
				$business_id = $row['business_id'];
				$firstname = $row['firstname'];
				$product_title = $row['product_title'];
				$product_price = $row['product_price'];
				$product_image = $row['product_image'];
				$product_date = $row['product_date'];
				
				$response[] = array("product_id" => $product_id,"business_id" => $business_id, "firstname" => $firstname, "product_title" => $product_title,    "product_price" => $product_price,"product_image" => $product_image,"product_date" => $product_date,'total_records' => $total_records);
			}
		}
		else
		{
			$response[] = array('total_records' => $total_records);
		}
		
	echo json_encode($response);
?>