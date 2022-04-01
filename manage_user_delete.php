<?php
include_once('../connection.php');
$response = array();
if(isset($_POST['delete']))
{
	if(isset($_POST['id']))
	{
		$sql_select = "select * from manage_user_tbl where user_id = '".$_POST['id']."'";
		$resultView = mysqli_query($con,$sql_select);
		if(mysqli_num_rows($resultView) > 0)
		{
			while($rowView = mysqli_fetch_array($resultView))
			{
				$image1 = $rowView['user_image'];
				$path = $_SERVER['DOCUMENT_ROOT'].'/tryon_project_btv/images/user_image/';
				if (file_exists($path.$image1)) 
				{
					unlink($path.$image1);
				}				
			}
		}
		
		$deleteSql = "CALL deleteManageUser('".$_POST['id']."')";
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