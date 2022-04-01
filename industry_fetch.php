<?php
include_once('../connection.php');
$response = array();
if(isset($_POST['edit']))	
{
	if(isset($_POST['id']))
	{
		$fetchSql = "CALL fetchIndustry('".$_POST['id']."')";
		$result = mysqli_query($con,$fetchSql);		
		while($row = mysqli_fetch_array($result))
		{
			$response["industry_type"] = $row["industry_type"];		
		}		
	}		
}
else
{
	$response["Fail"] = 1;
}
echo json_encode($response);

?>