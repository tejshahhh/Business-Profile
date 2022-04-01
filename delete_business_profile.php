<?php
include_once('../connection.php');
$response = array();
if(isset($_POST['delete']))
{
	if(isset($_POST['id']))
	{
		$sql_select = "SELECT * FROM business_profile_tbl where business_id = '".$_POST['id']."'";
		$resultView = mysqli_query($con,$sql_select);
		if(mysqli_num_rows($resultView) > 0)
		{
			while($rowView = mysqli_fetch_array($resultView))
			{
				$image1 = $rowView['profile_img'];
				$path = $_SERVER['DOCUMENT_ROOT'].'/tryon_project_btv/images/profile_image/';
				if (file_exists($path.$image1)) 
				{
					unlink($path.$image1);
				}				
			}	
			
		 }
		 $sql_select = "SELECT * FROM business_profile_tbl where business_id = '".$_POST['id']."'";
			$resultView = mysqli_query($con,$sql_select);
			if(mysqli_num_rows($resultView) > 0)
			{
				while($rowView = mysqli_fetch_array($resultView))
				{
					$image2 = $rowView['background_img'];
					$path = $_SERVER['DOCUMENT_ROOT'].'/tryon_project_btv/images/background_image/';
					if (file_exists($path.$image2)) 
					{
						unlink($path.$image2);
					}				
				}	
				
			 }
			
			
			$deleteSqled = "DELETE FROM education_tbl WHERE business_id = '".$_POST['id']."'";
			//echo $deleteSqled;
			$rs_delete_Sqled = mysqli_query($con,$deleteSqled);
			
			
			$deleteSqlex = "DELETE FROM experience_tbl WHERE business_id = '".$_POST['id']."'";
			$rs_delete_Sqlex = mysqli_query($con,$deleteSqlex);
			
			$deleteSql = "DELETE FROM business_profile_tbl WHERE business_id = '".$_POST['id']."'";
			$rs_delete_Sql = mysqli_query($con,$deleteSql);
						  
		
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