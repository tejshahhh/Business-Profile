<?php
include_once('../connection.php');
$response = array();
if(isset($_POST['delete']))
{
	if(isset($_POST['id']))
	{
		$deleteSql = "CALL deleteEmployementType('".$_POST['id']."')";
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