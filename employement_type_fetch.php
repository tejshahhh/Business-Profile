<?php
include_once('../connection.php');
$response = array();
if(isset($_POST['edit']))	
{
	if(isset($_POST['id']))
	{
		$fetchSql = "CALL fetchEmployementType('".$_POST['id']."')";
		$result = mysqli_query($con,$fetchSql);		
		while($row = mysqli_fetch_array($result))
		{
			$response["employement_type_name"] = $row["employement_type_name"];		
		}		
	}		
}
else
{
	$response["Fail"] = 1;
}
echo json_encode($response);

?>