<?php

	include_once('connection.php');
	$response = array();
	
	if(isset($_POST['modal']))
	{
		if(isset($_POST['business_id']))
		{
			$sql = "SELECT * FROM website_tbl WHERE business_id = '".$_POST['business_id']."' ";
		
		
		$run = mysqli_query($con,$sql);
		//echo $sql;
		while($row = mysqli_fetch_array($run))
			{
				$website_name = $row['website_name'];
				$website_type = $row['website_type'];
				
				$response[] = array("website_name" => $website_name,"website_type" => $website_type);
			}
		}
		else
		{
			$response = '';
		}
	}
		
	echo json_encode($response);
	
?>